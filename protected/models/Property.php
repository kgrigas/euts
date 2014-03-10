<?php

/**
 * This is the model class for table "property".
 *
 * The followings are the available columns in table 'property':
 * @property integer $id
 * @property string $ref
 * @property string $flatNum
 * @property string $houseNum
 * @property string $street
 * @property string $postcode
 * @property string $area
 * @property string $town
 * @property string $region
 * @property double $lat
 * @property double $lng
 * @property string $status
 * @property integer $show
 * @property string $url
 * @property string $metaTitle
 * @property string $metaDescription
 * @property string $metaKeywords
 * @property string $searchTags
 * @property integer $wom
 * @property integer $featured
 * @property integer $updated
 * @property integer $created
 * @property-read string address
 */
class Property extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'property';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('show, wom, featured, updated, created', 'numerical', 'integerOnly' => true),
			array('lat, lng', 'numerical'),
			array('ref, flatNum, houseNum, street, postcode, area, town, region, status, url, metaTitle, metaDescription', 'length', 'max' => 255),
			array('id, ref, flatNum, houseNum, street, postcode, area, town, region, lat, lng, status, show, url, metaTitle, metaDescription, metaKeywords, searchTags, wom, featured, updated, created', 'safe', 'on' => 'search'),
		);
	}


	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'finance' => array(self::HAS_ONE, 'PropertyFinance', 'propId'),
			'images' => array(self::HAS_MANY, 'PropertyImage', 'propId'),
			'media' => array(self::HAS_ONE, 'PropertyMedia', 'propId'),
			'spec' => array(self::HAS_ONE, 'PropertySpec', 'propId'),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'ref' => 'Ref',
			'flatNum' => 'Flat Num',
			'houseNum' => 'House Num',
			'street' => 'Street',
			'postcode' => 'Postcode',
			'area' => 'Area',
			'town' => 'Town',
			'region' => 'Region',
			'lat' => 'Lat',
			'lng' => 'Lng',
			'status' => 'Status',
			'show' => 'Show',
			'url' => 'Url',
			'metaTitle' => 'Meta Title',
			'metaDescription' => 'Meta Description',
			'metaKeywords' => 'Meta Keywords',
			'searchTags' => 'Search Tags',
			'wom' => 'Wom',
			'featured' => 'Featured',
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
		$criteria->compare('ref', $this->ref, true);
		$criteria->compare('flatNum', $this->flatNum, true);
		$criteria->compare('houseNum', $this->houseNum, true);
		$criteria->compare('street', $this->street, true);
		$criteria->compare('postcode', $this->postcode, true);
		$criteria->compare('area', $this->area, true);
		$criteria->compare('town', $this->town, true);
		$criteria->compare('region', $this->region, true);
		$criteria->compare('lat', $this->lat);
		$criteria->compare('lng', $this->lng);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('show', $this->show);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('metaTitle', $this->metaTitle, true);
		$criteria->compare('metaDescription', $this->metaDescription, true);
		$criteria->compare('metaKeywords', $this->metaKeywords, true);
		$criteria->compare('searchTags', $this->searchTags, true);
		$criteria->compare('wom', $this->wom);
		$criteria->compare('featured', $this->featured);
		$criteria->compare('updated', $this->updated);
		$criteria->compare('created', $this->created);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Property the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function getAddress() {
		return $this->houseNum.(!empty($this->flatNum) ? '/'.$this->flatNum : false).' '.$this->street.(!empty($this->area) ? ', '.$this->area : false).(!empty($this->town) ? ', '.$this->town : false).(!empty($this->region) ? ', '.$this->region : false);
	}

}
