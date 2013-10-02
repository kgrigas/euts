<?php

class SiteController extends Controller
{

	public $breadcrumbs;
	public $layout = 'main';

	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}


	public function actionIndex() {
		$this->render('index');
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest) {
	    		echo $error['message'];
	    	} else {
	    		$this->layout = 'content';
	        	$this->render('error', $error);
	    	}
	    }
	}
}