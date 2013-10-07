<?php

/**
 * This is the model class for table "mfg_email_templates".
 *
 * The followings are the available columns in table 'mfg_email_templates':
 * @property integer $id
 * @property string $name
 * @property string $body
 * @property integer $updated
 * @property integer $created
 *
 * The followings are the available model relations:
 * @property EmailRule[] $mfgEmailRules
 */
class EmailTemplate extends ActiveRecord
{

	public $bodyFull='';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmailTemplate the static model class
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
		return 'email_templates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		return array(
			array('name, body', 'required'),
			array('updated, created', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('name','unique'),
			array('updated','default', 'value'=>time(), 'setOnEmpty'=>false,'on'=>'update'),
			array('updated,created','default', 'value'=>time(), 'setOnEmpty'=>false,'on'=>'insert'),
			array('id, name, body, updated, created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		return array(
			'emailRules' => array(self::HAS_MANY, 'MfgEmailRules', 'templateId'),
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
			'body' => 'Body',
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
		//$criteria->compare('body',$this->body,true);
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