<?php

/**
 * This is the model class for table "property_image".
 *
 * The followings are the available columns in table 'property_image':
 * @property integer $id
 * @property integer $propId
 * @property string $name
 * @property integer $orderId
 * @property string $measurements
 * @property string $title
 * @property string $description
 * @property integer $updated
 * @property integer $created
 */
class PropertyImage extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'property_image';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('propId, orderId, updated, created', 'numerical', 'integerOnly' => true),
			array('name, measurement, title, description', 'length', 'max' => 255),
			array('id, propId, name, orderId, updated, created', 'safe', 'on' => 'search'),
		);
	}


	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'property' => array(self::BELONGS_TO, 'Property', 'propId'),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'propId' => 'Prop',
			'name' => 'Name',
			'orderId' => 'Order',
			'updated' => 'Updated',
			'created' => 'Created',
		);
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('propId', $this->propId);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('orderId', $this->orderId);
		$criteria->compare('updated', $this->updated);
		$criteria->compare('created', $this->created);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PropertyImage the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
}
