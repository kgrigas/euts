<?php

class PropertiesController extends Controller
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

	public function actionSearch(){
		$properties = new Properties;
		$properties->unsetAttributes();
		$properties->status = 'published';
		$this->render('search', array('properties' => $properties));
	}

	public function actionView($id){
		$property = Properties::Model()->findByPk($id);
		
		if(!empty($property)){
			
		}else{
			throw new CHttpException(404,'The requested page does not exist.');
		}
		
		$this->render('view', array('property' => $property));
	}
}