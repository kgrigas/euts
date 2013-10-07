<?php

/**
 * This is the model class for table "mfg_email_rules".
 *
 * The followings are the available columns in table 'mfg_email_rules':
 * @property integer $id
 * @property string $name
 * @property integer $templateId
 * @property string $to
 * @property string $cc
 * @property string $bcc
 * @property string $from
 * @property string $subject
 * @property string $status
 * @property string $chaserId
 * @property string $runTime
 * @property integer $updated
 * @property integer $created
 */
class EmailRule extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmailRule the static model class
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
		return 'email_rule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, templateId, to, status', 'required'),
			array('templateId, updated, created', 'numerical', 'integerOnly'=>true),
			array('name, from, subject', 'length', 'max'=>255),
			array('name','unique'),
			array('templateId','exists','classname'=>'MfgEmailTemplates','attributeName'=>'id'),
			array('updated','default', 'value'=>time(), 'setOnEmpty'=>false,'on'=>'update'),
			array('updated,created','default', 'value'=>time(), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, templateId, to, cc, bcc, from, subject, status, chaserId, runTime, updated, created', 'safe', 'on'=>'search'),
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
			'template' => array(self::BELONGS_TO, 'MfgEmailTemplates', 'templateId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'templateId' => 'Template',
			'to' => 'To',
			'cc' => 'Cc',
			'bcc' => 'Bcc',
			'from' => 'From',
			'subject' => 'Subject',
			'status' => 'Status',
			'chaserId' => 'Chaser Email Rule',
			'runTime' => 'Time Delay',
			'updated' => 'Updated',
			'created' => 'Created',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('templateId',$this->templateId);
		$criteria->compare('`to`',$this->to,true);
		$criteria->compare('cc',$this->cc,true);
		$criteria->compare('bcc',$this->bcc,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('chaserId',$this->chaserId,true);
		$criteria->compare('runTime','>='.strtotime($this->runTime));
		$criteria->compare('updated','>='.strtotime($this->updated));
		$criteria->compare('created','>='.strtotime($this->created));

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
	            'defaultOrder'=>'name ASC',
	        ),
			'pagination'=>array(
				'pageSize'=>50
	        ),
		));
	}
}