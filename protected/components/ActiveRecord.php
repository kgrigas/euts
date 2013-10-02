<?php
class ActiveRecord extends CActiveRecord {

	public $modelOld;

	//modified so sql updates are not ran if not changes have been made
	public function save($runValidation=true,$attributes=null){
		if(!$runValidation || $this->validate($attributes)){
			if($this->getIsNewRecord()){
				$class = get_class($this);
				$this->modelOld = new $class;
				return $this->insert($attributes);
			} else {
				$this->modelOld = $this->findByPk($this->id);
				if (empty($this->modelOld) || $this->attributes != $this->modelOld->attributes) {
					return $this->update($attributes);
				} else {
					return true;
				}
			}
		} else {
			return false;
		}
	}

	public function camelCase($string) {
		return Yii::app()->format->camelCase($this->$string);
	}

}