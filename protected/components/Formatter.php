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

}