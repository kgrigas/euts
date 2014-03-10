<?php

/**
 * This is the model class for table "property_media".
 *
 * The followings are the available columns in table 'property_media':
 * @property integer $id
 * @property integer $propId
 * @property integer $epc
 * @property integer $brochure
 * @property integer $floorPlan1
 * @property integer $floorPlan2
 * @property integer $floorPlan3
 * @property integer $map1
 * @property integer $map2
 * @property integer $energy1
 * @property integer $energy2
 * @property integer $created
 * @property integer $updated
 */
class PropertyMedia extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'property_media';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('id, propId, epc, brochure, floorPlan1, floorPlan2, floorPlan3, map1, map2, energy1, energy2, created, updated', 'numerical', 'integerOnly' => true),
			array('id, propId, epc, brochure, floorPlan1, floorPlan2, floorPlan3, map1, map2, energy1, energy2, created, updated', 'safe', 'on' => 'search'),
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
			'epc' => 'Epc',
			'brochure' => 'Brochure',
			'floorPlan1' => 'Floor Plan1',
			'floorPlan2' => 'Floor Plan2',
			'floorPlan3' => 'Floor Plan3',
			'map1' => 'Map1',
			'map2' => 'Map2',
			'energy1' => 'Energy1',
			'energy2' => 'Energy2',
			'created' => 'Created',
			'updated' => 'Updated',
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
		$criteria->compare('epc', $this->epc);
		$criteria->compare('brochure', $this->brochure);
		$criteria->compare('floorPlan1', $this->floorPlan1);
		$criteria->compare('floorPlan2', $this->floorPlan2);
		$criteria->compare('floorPlan3', $this->floorPlan3);
		$criteria->compare('map1', $this->map1);
		$criteria->compare('map2', $this->map2);
		$criteria->compare('energy1', $this->energy1);
		$criteria->compare('energy2', $this->energy2);
		$criteria->compare('created', $this->created);
		$criteria->compare('updated', $this->updated);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PropertyMedia the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
}
