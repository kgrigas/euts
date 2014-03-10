<?php

/**
 * This is the model class for table "mfg_email_pending".
 *
 * The followings are the available columns in table 'mfg_email_pending':
 * @property integer $id
 * @property string $to
 * @property string $cc
 * @property string $bcc
 * @property string $from
 * @property string $subject
 * @property string $body
 * @property string $attach
 * @property integer $runTime
 * @property integer $sent
 * @property integer $failed
 * @property integer $cancelTime
 * @property string $cancelReason
 * @property string $data
 * @property integer $updated
 * @property integer $created
 *
 * The followings are the available model relations:
 * @property EmailTemplate $template
 */
class EmailPending extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmailPending the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}


	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'email_pending';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('to,from,runTime,subject,body', 'required'),
			array('runTime, cancelTime, updated, created', 'numerical', 'integerOnly' => true),
			array('subject, errorMessage', 'length', 'max' => 255),
			array('updated', 'default', 'value' => time(), 'setOnEmpty' => false, 'on' => 'update'),
			array('updated,created', 'default', 'value' => time(), 'setOnEmpty' => false, 'on' => 'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, to, cc, bcc, from, subject, body, runTime, sent, failed, refId, refType, updated, created', 'safe', 'on' => 'search'),
		);
	}


	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array();
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'to' => 'To',
			'cc' => 'Cc',
			'bcc' => 'Bcc',
			'from' => 'From',
			'subject' => 'Subject',
			'body' => 'Body',
			'attach' => 'Attachment',
			'runTime' => 'Run Time',
			'cancelTime' => 'Cancelled Time',
			'errorMessage' => 'Error Message',
			'sent' => 'Time Sent at',
			'failed' => 'Time Failed to Send at',
			'data' => 'Associated Data',
			'updated' => 'Updated',
			'created' => 'Created',
		);
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('`to`', $this->to, true);
		$criteria->compare('cc', $this->cc, true);
		$criteria->compare('bcc', $this->bcc, true);
		$criteria->compare('from', $this->from, true);
		$criteria->compare('subject', $this->subject, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('attach', $this->attach, true);
		$criteria->compare('runTime', '>=' . strtotime($this->runTime));
		$criteria->compare('sent', '>=' . strtotime($this->sent));
		$criteria->compare('failed', $this->failed);
		$criteria->compare('cancelTime', $this->cancelTime);
		$criteria->compare('errorMessage', $this->errorMessage, true);
		$criteria->compare('data', $this->data, true);
		$criteria->compare('updated', '>=' . strtotime($this->updated));
		$criteria->compare('created', '>=' . strtotime($this->created));

		$criteria->order = 'runTime DESC';

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}