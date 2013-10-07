<?php

class Controller extends CController
{

	public $layout='//layouts/main';

	protected function honeypot() {
		return (!empty($_POST) && ((isset($_POST['honeypot']) && $_POST['honeypot'] === '') || (isset($_POST['phonePot']) && $_POST['phonePot'] === '')));
	}
}