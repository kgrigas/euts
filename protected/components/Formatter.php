<?php

class Formatter extends CFormatter {

	/**
	 * Converts camelCaseValue to normal value
	 * @param string $value
	 * @return string
	 */
	public function formatCamelCase($value) {
		return ucfirst(implode(" ",preg_split("/(?=[A-Z])/",$value)));
	}

	/**
	 * Prepends pound sign and formats the number
	 * @param string $value
	 * @return string
	 */
	public function formatCurrency($value) {
		return '£'.Yii::app()->format->number(floatval($value));
	}


	/**
	 * Strips away "Edinburgh" and "United Kingdom" parts from comma separated string
	 * @param string $value
	 * @return string
	 */
	public function formatLocation($value) {
		return implode(',',array_filter(explode(',',$value), function($val){
			return (strpos(strtolower($val), 'edinburgh') === false) && (strpos(strtolower($val), 'united kingdom') === false);
		}));
	}


	public function formatDayDateTime($value) {
		return date('l, M d, H:i', $value);
	}
}