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

		$news = Yii::app()->cache->get('news');
		if ($news === false) {
			$json = $this->url_get_contents("http://www.google.com/calendar/feeds/info@edinburghtango.org.uk/public/full?alt=json&orderby=starttime&max-results=2&singleevents=true&sortorder=ascending&futureevents=true");
			$var = json_decode($json);

			$news = array();

			foreach ($var->feed->entry as $entry) {
				$news[] = array(
					'title'=>$entry->title->{'$t'},
					'content'=>substr($entry->content->{'$t'},0,100).'...',
					'location'=>$entry->{'gd$where'}[0]->valueString,
					'time'=>strtotime($entry->{'gd$when'}[0]->startTime)
				);
			}
			Yii::app()->cache->set('news',$news,1800);
		}

		$this->render('index', array(
			'news'=>$news,
		));
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
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

	public function actionGoogle() {
		$json = file_get_contents("http://www.google.com/calendar/feeds/info@edinburghtango.org.uk/public/full?alt=json&orderby=starttime&max-results=3&singleevents=true&sortorder=ascending&futureevents=true");
		$var = json_decode($json);
		var_dump($var->feed->entry[0]);

	}

	private function url_get_contents($url) {
		if (!function_exists('curl_init')){
			die('CURL is not installed!');
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}
}