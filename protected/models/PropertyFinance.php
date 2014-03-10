<?php

/**
 * This is the model class for table "property_finance".
 *
 * The followings are the available columns in table 'property_finance':
 * @property integer $id
 * @property integer $propId
 * @property integer $price
 * @property string $priceType
 * @property string $saleType
 * @property integer $updated
 * @property integer $created
 */
class PropertyFinance extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'property_finance';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('propId, price, updated, created', 'numerical', 'integerOnly' => true),
			array('priceType, saleType', 'length', 'max' => 255),
			array('id, propId, price, priceType, saleType, updated, created', 'safe', 'on' => 'search'),
		);
	}


	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'property'=>array(self::BELONGS_TO,'Property','propId'),
		);

	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'propId' => 'Prop',
			'price' => 'Price',
			'priceType' => 'Price Type',
			'saleType' => 'Sale Type',
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
		$criteria->compare('price', $this->price);
		$criteria->compare('priceType', $this->priceType, true);
		$criteria->compare('saleType', $this->saleType, true);
		$criteria->compare('updated', $this->updated);
		$criteria->compare('created', $this->created);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PropertyFinance the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
}
