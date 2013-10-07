<?php

/**
 * This is the model class for table "mfg_email_archive".
 *
 * The followings are the available columns in table 'mfg_email_archive':
 * @property integer $id
 * @property string $to
 * @property string $cc
 * @property string $bcc
 * @property string $from
 * @property string $subject
 * @property string $body
 * @property integer $runTime
 * @property integer $sent
 * @property integer $failed
 * @property integer $cancelTime
 * @property string $cancelReason
 * @property string $error
 * @property integer $updated
 * @property integer $created
 */
class EmailArchive extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmailArchive the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'email_archive';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('refId, runTime, sent, failed, cancelTime, updated, created', 'numerical', 'integerOnly'=>true),
			array('refType, to, from, subject', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('to, cc, bcc, from, subject, body, attach, runTime, sent, failed, cancelTime, cancelReason, error,  refId, refType, data, updated, created', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'to' => 'To',
			'cc' => 'Cc',
			'bcc' => 'Bcc',
			'from' => 'From',
			'subject' => 'Subject',
			'body' => 'Body',
			'runTime' => 'Run Time',
			'sent' => 'Sent',
			'failed' => 'Failed',
			'cancelTime' => 'Cancel Time',
			'cancelReason' => 'Cancel Reason',
			'error' => 'Error',
			'updated' => 'Updated',
			'created' => 'Created',
			'refId' => 'Reference ID',
			'refType' => 'Reference Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('`to`',$this->to,true);
		$criteria->compare('cc',$this->cc,true);
		$criteria->compare('bcc',$this->bcc,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('runTime','>='.strtotime($this->runTime));
		$criteria->compare('sent','>='.strtotime($this->sent));
		$criteria->compare('failed',$this->failed);
		$criteria->compare('cancelTime',$this->cancelTime);
		$criteria->compare('cancelReason',$this->cancelReason,true);
		$criteria->compare('error',$this->error,true);
		$criteria->compare('updated','>='.strtotime($this->updated));
		$criteria->compare('created','>='.strtotime($this->created));
		$criteria->compare('refId',$this->refId);
		$criteria->compare('refType',$this->refType);

		$criteria->order = 'runTime DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}