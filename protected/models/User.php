<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $fName
 * @property string $sName
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $postcode
 * @property integer $created
 * @property integer $updated
 */
class User extends ActiveRecord
{
	private $_fullName;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fName, sName, email, phone, address, postcode, price', 'required'),
			array('created, updated', 'numerical', 'integerOnly'=>true),
			array('fName, sName, email, phone, postcode, price', 'length', 'max'=>255),
			array('email','email'),
			array('id, fName, sName, email, phone, address, price, comments, postcode, created, updated', 'safe', 'on'=>'search'),
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
			'fName' => 'First name',
			'sName' => 'Surname',
			'email' => 'Email',
			'phone' => 'Phone',
			'address' => 'Address',
			'postcode' => 'Postcode',
			'price' => 'Approximate Valuation of Property',
			'comments' => 'Additional comments or questions',
			'created' => 'Created',
			'updated' => 'Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('fName',$this->fName,true);
		$criteria->compare('sName',$this->sName,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
		$criteria->compare('price',$this->price);
		$criteria->compare('comments',$this->comments);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getFullName() {
		if (empty($this->_fullName)) {
			if(!empty($this->fName) && !empty($this->sName)){
				$this->_fullName = $this->fName.' '.$this->sName;
			}elseif(!empty($this->title) && !empty($this->sName)){
				$this->_fullName = $this->title.' '.$this->sName;
			}elseif(!empty($this->fName)){
				$this->_fullName = $this->fName;
			}elseif(!empty($this->sName)){
				$this->_fullName = $this->sName;
			}
		}
		return $this->_fullName;
	}

	public function setFullName($value) {
		$this->_fullName = $value;
	}

}
