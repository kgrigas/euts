<?php

/**
 * This is the model class for table "property_spec".
 *
 * The followings are the available columns in table 'property_spec':
 * @property integer $id
 * @property integer $propId
 * @property string $type
 * @property string $description
 * @property string $viewingText
 * @property integer $bathrooms
 * @property integer $publicRooms
 * @property integer $bedrooms
 * @property string $summary
 * @property string $garage
 * @property string $garden
 * @property string $windows
 * @property string $parking
 * @property string $heating
 * @property integer $newBuild
 * @property integer $updated
 * @property integer $created
 */
class PropertySpec extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'property_spec';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('propId, bathrooms, publicRooms, bedrooms, newBuild, updated, created', 'numerical', 'integerOnly' => true),
			array('type', 'length', 'max' => 100),
			array('windows, garage, garden, parking, heating', 'length', 'max' => 255),
			array('id, propId, type, description, viewingText, bathrooms, publicRooms, bedrooms, summary, garage, garden, windows, parking, newBuild, updated, created, age, construction', 'safe', 'on' => 'search'),
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
			'type' => 'Type',
			'description' => 'Description',
			'viewingText' => 'Viewing Text',
			'bathrooms' => 'Bathrooms',
			'publicRooms' => 'Public Rooms',
			'bedrooms' => 'Bedrooms',
			'summary' => 'Summary',
			'garage' => 'Garage',
			'garden' => 'Garden',
			'windows' => 'Windows',
			'parking' => 'Parking',
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
		$criteria->compare('type', $this->type, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('viewingText', $this->viewingText, true);
		$criteria->compare('bathrooms', $this->bathrooms);
		$criteria->compare('publicRooms', $this->publicRooms);
		$criteria->compare('bedrooms', $this->bedrooms);
		$criteria->compare('summary', $this->summary, true);
		$criteria->compare('garage', $this->garage);
		$criteria->compare('garden', $this->garden);
		$criteria->compare('windows', $this->windows, true);
		$criteria->compare('parking', $this->parking);
		$criteria->compare('newBuild', $this->newBuild, true);
		$criteria->compare('updated', $this->updated);
		$criteria->compare('created', $this->created);


		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PropertySpec the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
}
