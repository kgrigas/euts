<?php class EmailHelper extends CApplicationComponent{


	/**
	 * @var array Data for the current email
	 */
	protected $data = array();

	/**
	 * @var EmailPending Current email
	 */
	protected $email;

	/**
	 * @var YiiMailer Email Component
	 */
	protected $mailer;

	function init() {
		Yii::import('ext.YiiMailer.YiiMailer');
		$this->mailer = new YiiMailer();
	}

	/**
	 * @param array $data
	 * @return boolean Whether email was saved
	 */
	public function add($data=array()){
		if(!empty($data)){
			$this->data = $data;
		}

		$saved = $this->processMail();

		$this->reset();
		return $saved;
	}

	protected function reset(){
		$this->data = array();
		$this->email = null;
	}

	/**
	 * @return boolean Whether email was saved
	 */
	protected function processMail(){
		$saved = false;
		$this->email = new EmailPending;

		$this->setRecipients();
		$this->setTemplate();
		$this->setContent();
		$this->setAttachments();
		$this->setRunTime();

		if ($this->saveEmail() && empty($this->email->failed) && empty($this->email->cancelTime)) {
			$saved = true;
		}

		return $saved;
	}

	/**
	 * @return boolean Whether email was saved
	 */
	protected function saveEmail(){
		$preserveData = array();
		foreach($this->data as $model){
			if(!empty($model) && is_object($model) && !empty($model->id)){
				if(!empty($this->email->data[get_class($model)])){
					if(is_array($preserveData[get_class($model)])){
						$preserveData[get_class($model)][] = $model->id;
					}else{
						$preserveData[get_class($model)] = array(
							$preserveData[get_class($model)],
							$model->id,
						);
					}
				}else{
					$preserveData[get_class($model)] = $model->id;
				}
			}
		}
		if(!empty($preserveData)){
			$this->email->data=serialize($preserveData);
		}

		if(!empty(Yii::app()->user) && !empty(Yii::app()->user->id)){
			$this->email->addedBy = Yii::app()->user->id;
		}

		if(!empty($this->data['enquiry']['id'])){
			$this->email->refId = $this->data['enquiry']['id'];
			$this->email->refType="enquiry";
		}elseif(!empty($this->data['property']['id'])){
			$this->email->refId = $this->data['property']['id'];
			$this->email->refType="property";
		}elseif(!empty($this->data['staff']['id'])){
			$this->email->refId = $this->data['staff']['id'];
			$this->email->refType = 'staff';
		}

		$this->email->validate(null,false);

		if (!empty($this->email->errors)) {
			$this->email->setScenario('failSave');
			$this->email->errorMessage = serialize($this->email->errors);
			$this->email->failed = time();
		}

		if($this->email->save()){
			return true;
		} else {
			Yii::log('Email not saved. Error: '.print_r($this->email->errors, true).' Model: '.print_r($this->email->attributes, true),'warning','application.components.EmailHelper');
			return false;
		}
	}

	protected function setRunTime(){
		if (!empty($this->data['rule']['runTime'])) {
			$this->email->runTime = strtotime($this->data['rule']['runTime']);
		} else {
			$this->email->runTime = strtotime('+15 min');
		}
	}

	protected function setRecipients(){
		$types = array('to','cc','bcc','from');
		$emailValidator = new CEmailValidator;
		$emailValidator->allowName = true;

		foreach($types as $type){
			$recipients = array();
			$keywords = array();
			if(!empty($this->data['rule']->$type)){
				$keywords = explode(',',$this->data['rule']->$type);
			}

			foreach($keywords as $keyword){
				$recipient = null;

				// Unsubscriptions
				if (!empty($this->data[$keyword]) && in_array(get_class($this->data[$keyword]),array('MfgUsers','MfgSellers','MfgIntroducers'))) {
					if (get_class($this->data[$keyword]) == 'MfgUsers') {
						$userModel = $this->data[$keyword];
					} else {
						$userModel = $this->data[$keyword]->user;
					}

					if ($this->data['rule']->promotional == 1 && $userModel->unsubscribe == 1) {
						$this->email->addError($type,$userModel->fullName.' has unsubscribed from promotional emails.');
					} elseif ($this->data['rule']->promotional == 1 && $userModel->unsubscribe == 2) {
						$this->email->addError($type,$userModel->fullName.' has unsubscribed from all emails.');
					} elseif (!empty($this->data['rule']->group)) {
						$emailSettings = $userModel->emailSettings(array('condition'=>'groupId='.$this->data['rule']->groupId));
						if (!empty($emailSettings)) {
							$this->email->addError($type,$userModel->fullName.' has opted out from this type of emails.');
						}
					}

					if ($type === 'to') {
						$this->email->userId = $userModel->id;
						$this->email->userType = get_class($userModel);
					}
				}


				if ($emailValidator->validateValue($keyword)) {
					$recipient = $keyword;
				} else {
					switch($keyword){
						case 'introducer':
						case 'seller':
							//$recipient = !empty($this->data[$keyword]->user->fullName) ? $this->data[$keyword]->user->fullName.' <'.$this->data[$keyword]->user->email.'>' : $this->data[$keyword]->user->email;
							$recipient = $this->data[$keyword]->user->email;
							break;

						case 'default':
							$recipient = 'email@mcewanfraserlegal.co.uk';
							break;

						case 'sender':
							if(!empty($this->data['sender']->email)){
								$recipient = !empty($this->data['sender']->fullName) ? $this->data['sender']->fullName.' <'.$this->data['sender']->email.'>' : $this->data['sender']->email;
							}
							break;

						case 'windowNetwork':
							if(!empty($this->data['windowNetwork']) && !empty($this->data['windowNetwork']->windowEmail)){
								$recipient = $this->data['windowNetwork']->windowEmail;
							}
							break;

						default:
							//$recipient = !empty($this->data[$keyword]->fullName) ? $this->data[$keyword]->fullName.' <'.$this->data[$keyword]->email.'>' : $this->data[$keyword]->email;
							if (!empty($this->data[$keyword]->email)) {
								$recipient = $this->data[$keyword]->email;
							}
							break;
					}
				}

				if(!empty($recipient)){
					$recipients[] = $recipient;
				}
			}

			if(!empty($recipients)){
				$this->email->$type = implode(',',$recipients);
			}
		}
	}

	private function setAttachments() {
		$attachments = array();
		if (!empty($this->data['rule']['attach'])) {
			foreach (preg_split('/\n|\r/', $this->data['rule']['attach'], -1, PREG_SPLIT_NO_EMPTY) as $attachRule) {
				if (strpos($attachRule,'keyword:') === false) {
					$attachRule = str_replace('%%property_ref%%',$this->data['property']->ref,$attachRule);
					$attachments[] = $attachRule;
				} else {
					switch($attachRule) {
						case 'keyword:redemptionFigure':
							if (!empty($this->data['property'])) {
								Yii::import('application.extensions.file.CFile');
								$file = new CFile();
								$file = $file->set(Yii::app()->basePath.'/../../files/redemptionFigures/');
								foreach ($file->contents as $filename) {
									$currentFile = new CFile();
									$currentFile = $currentFile->set($filename);
									if (preg_match('/'.$this->data['property']->ref.'/',$currentFile->filename)) {
										$attachments[] = 'files/redemptionFigures/'.$currentFile->basename;
									}
								}
							}
							break;
						case 'keyword:standardClauses':
							switch ($this->data['property']->legal->standardClauses) {
								case 'abderdeen':
									$attachments[] = 'files/clauses/Aberdeenshire Standard Clauses (2013).pdf';
									break;
								case 'ayr':
									$attachments[] = 'files/clauses/Ayr Standard Clauses (2005).pdf';
									break;
								case 'borders':
									$attachments[] = 'files/clauses/Borders Standard Clauses (2007).pdf';
									break;
								case 'combined':
									$attachments[] = 'files/clauses/Combined Standard Clauses (2011).pdf';
									break;
								case 'highlands':
									$attachments[] = 'files/clauses/Highlands Standard Clauses (2007).pdf';
									break;
								case 'inverclyde':
									$attachments[] = 'files/clauses/Inverclyde Standard Clauses (2009).pdf';
									break;
								case 'paisley':
									$attachments[] = 'files/clauses/Paisley Standard Clauses.pdf';
									break;
								case 'tayside':
									$attachments[] = 'files/clauses/Tayside Standard Clauses (2008).pdf';
									break;
							}
							break;
						case 'keyword:idReceived':
							if (!empty($this->data['property'])) {
								if ($this->data['property']->legal->idReceived == 0) {
									$attachments[] = 'files/ID Requirements.pdf';
								}

							}
							break;
						case 'keyword:feeBreakdown':
							if (!empty($this->data['property']) && !empty($this->data['property']->spec->feeBreakdown)) {
								$attachments[] = 'files/feeBreakdowns/'.$this->data['property']->spec->feeBreakdown;
							}
							break;
						case 'keyword:eaForm':
							if (!empty($this->data['property']) && !empty($this->data['property']->spec->eaForm)) {
								$attachments[] = 'files/eaforms/'.$this->data['property']->spec->eaForm;
							}
							break;
					}
				}
			}
		}
		if (!empty($attachments)) {
			$this->email->attach = serialize($attachments);
		}
	}

	protected function setTemplate(){
		if(empty($this->data['template']) && !empty($this->data['rule'])){
			$this->data['template'] = EmailTemplate::model()->findByPk($this->data['rule']->templateId);
		}
	}

	protected function setContent(){
		$contents = array(
			'subject'=>$this->data['rule']['subject'],
			'body'=>$this->data['template']['body'],
		);

		foreach($contents as $section=>$content){
			if(!empty($content) && preg_match_all("/%%(.*?)?%%/",$content, $keywords)){
				foreach($keywords[1] as $keyword){
					$content = str_replace('%%'.$keyword.'%%',$this->insertKeyword($keyword),$content);
				}
			}
			$this->email->$section = $content;
		}
	}

	/**
	 * @param string $keyword
	 * @return string
	 */
	protected function insertKeyword($keyword) {
		$model = null;
		$format = null;
		$result = null;
		$modelName = '';
		$attrName = '';

		if (strpos($keyword,':') !== false) {
			$parts = explode(':',$keyword);
			$format = $parts[0];
			$keyword = $parts[1];
		}

		$parts = explode('_',$keyword);
		if(!empty($parts[0]) && !empty($parts[1])){
			$modelName = $parts[0];
			$attrName = $parts[1];
		}

		if ($format === 'render') {
			return $this->mailer->renderView('application.views.emails.snippets._'.$keyword,$this->data);
		} elseif ($format === 'url' && is_numeric($keyword)) {
			$userHash = 0;
			if (!empty($this->data['user'])) {
				$userHash = $this->data['user']->hash;
			} elseif(!empty($this->data['seller'])) {
				$userHash = $this->data['seller']->user->hash;
			} elseif(!empty($this->data['viewer'])) {
				$userHash = $this->data['viewer']->user->hash;
			}
			if (empty($userHash)) {
				$userHash = 'unknown';
			}
			return 'https://www.mcewanfraserlegal.co.uk/external/email-'.$userHash.'/'.$keyword;
		} else {
			switch($modelName){

				case 'other':
					$model = new stdClass();
					if (!empty($this->data['other'])) {
						foreach ($this->data['other'] as $key=>$attribute) {
							$model->$key = $attribute;
						}
					}
					break;

				case 'postProduction':
					if (!empty($this->data['property'])) {
						$model = $this->data['property']->postProd;
					}
					break;

				case 'property':
					if(!empty($this->data['property'])){
						if (isset($this->data['property']->$attrName)) {
							$model = $this->data['property'];
						} elseif (isset($this->data['property']->propertyPortalAssign->$attrName)) {
							$model = $this->data['property']->propertyPortalAssign;
						} elseif (isset($this->data['property']->finance->$attrName)) {
							$model = $this->data['property']->finance;
						} elseif (isset($this->data['property']->postProd->$attrName)) {
							$model = $this->data['property']->postProd;
						} elseif (isset($this->data['property']->spec->$attrName)) {
							$model = $this->data['property']->spec;
						} elseif (isset($this->data['property']->legal->$attrName)) {
							$model = $this->data['property']->legal;
						}
					}
					break;

				case 'buyer':
				case 'seller':
				case 'tenant':
					if(!empty($this->data[$modelName])){
						if (isset($this->data[$modelName]->$attrName)) {
							$model = $this->data[$modelName];
						} elseif (isset($this->data[$modelName]->user->$attrName)) {
							$model = $this->data[$modelName]->user;
						}
					}
					break;

				default:
					if(!empty($this->data[$modelName]) && is_object($this->data[$modelName])){
						$model = $this->data[$modelName];
					}
			}

			if(empty($model)){
				$this->email->addError('body','Can\'t find model: '.$modelName);
				Yii::log('Can\'t find model: '.$modelName.'. Rule: '.$this->data['rule']->id,'error','application.components.EmailHelper');
			}

			if (isset($model->$attrName)) {
				$result = $model->$attrName;
			} else {
				$this->email->addError('body','Can\'t find data insert exception: '.$modelName.'_'.$attrName);
				Yii::log('Can\'t find data insert exception: '.$modelName.'_'.$attrName.'. Rule: '.$this->data['rule']->id,'error','application.components.EmailHelper');
			}

			if (!empty($format)) {
				switch($format) {
					case 'boolean':
						$result = Yii::app()->format->boolean($result);
						break;
					case 'currency':
						$result = '&pound;'.Yii::app()->format->number(floatval($result));
						break;
					case 'date':
						$result = Yii::app()->format->date($result);
						break;
					case 'datetime':
						$result = Yii::app()->format->datetime($result);
						break;
					case 'number':
						$result = Yii::app()->format->number(floatval($result));
						break;
					case 'time':
						$result = Yii::app()->format->time($result);
						break;
					case 'uppercase':
						$result = ucfirst($result);
						break;
					case 'url':
						$userHash = 0;
						if (!empty($this->data['user'])) {
							$userHash = $this->data['user']->hash;
						} elseif(!empty($this->data['seller'])) {
							$userHash = $this->data['seller']->user->hash;
						} elseif(!empty($this->data['viewer'])) {
							$userHash = $this->data['viewer']->user->hash;
						}
						$result = 'https://www.mcewanfraserlegal.co.uk/external/email-'.$userHash.'/'.$result;
						break;
				}
			}

			return $result;
		}
	}

	public function sendPendingMail(){
		$emails = EmailPending::Model()->findAll('sent=0 AND failed=0 AND cancelTime=0 AND runTime<'.time());
		foreach($emails as $email){
			$mail = $this->mailer;
			$mail->clear();

			$mail->setFrom($email->from, 'McEwan Fraser Legal');
			$mail->Sender = $email->from;
			$mail->ReturnPath = $email->from;

			if (strpos($email->to,',') !== false) {
				$mail->setTo(explode(',',$email->to));
			} else {
				$mail->setTo($email->to);
			}

			if (strpos($email->cc,',') !== false) {
				$mail->setCc(explode(',',$email->cc));
			} else {
				$mail->setCc($email->cc);
			}

			if (strpos($email->bcc,',') !== false) {
				$mail->setBcc(explode(',',$email->bcc));
			} else {
				$mail->setBcc($email->bcc);
			}

			if (!empty($email->attach)) {
				$attachments = unserialize($email->attach);
				if (!is_array($attachments)) {
					$attachments = array($attachments);
				}

				foreach ($attachments as $attachment) {
					$mail->setAttachment(realpath(Yii::app()->basePath.'/../../').'/'.$attachment);
				}
			}

			$mail->setBody($email->body);
			$mail->setSubject($email->subject);
			if($email->sms == 1){
				$mail->setLayout('sms');
			}else{
				$mail->setLayout('mail');
				$mail->isHTML(true);
			}

			if($mail->send()){
				$email->sent = time();
			}else{
				$email->errorMessage = serialize($mail->getError());
				Yii::log('Email ID:'.$email->id.' - '.$mail->getError(), 'warning', 'emailWarning');
				$email->failed = time();
			}
			//$email->data = $mail->getData();
			if (!$email->save()) {
				Yii::log('Couldn\'t save email model - email ID:'.$email->id.' - '.print_r($email->errors,true).' - '.print_r($email->attributes,true), 'warning', 'emailWarning');
			}
		}
	}

	/**
	 * Remove emails from the archive that are older 3 months
	 * @return boolean
	 */
	public function cleanArchive(){
		return EmailArchive::Model()->deleteAll('updated<'.strtotime('-3 months'));
	}


	/**
	 * Move emails from pending table to archive
	 */
	public function cleanPending(){
		$emails = EmailPending::Model()->findAll('sent>0 OR cancelTime>0 OR failed>0');
		foreach($emails as $email){
			$archive = new EmailArchive();
			$archive->attributes = $email->attributes;
			if ($archive->save()) {
				$email->delete();
			}
		}
	}
}