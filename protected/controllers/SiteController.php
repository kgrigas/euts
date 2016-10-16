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

		//News
		$news = Yii::app()->cache->get('news');
		$news = false;

		if ($news === false) {
			$news = $this->getGoogleEvents();
			Yii::app()->cache->set('news',$news,1800);
		}

		//Blog
		$blogPosts = WPPosts::model()->findAllByAttributes(array("post_status"=>"publish"),array("order"=>"post_date DESC"));

		$this->render('index', array(
			'news'=>$news,
			'blogPosts'=>$blogPosts,
		));
	}

	public function actionFeedback(){
		if (!empty($_POST['feedback'])){
			$feedback = new Feedback();
			$feedback->text = $_POST['feedback'];
			if ($feedback->save()) {
				$this->redirect('thankyou');
			} else {
				$this->render('feedback');
			}
		} else {
			$this->render('feedback');
		}
	}

	public function actionThankYou(){
		$this->render('thankyou');
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

	public function getGoogleEvents() {
		//Override Yii's autoloading to allow google autoloading
		spl_autoload_unregister(array('YiiBase','autoload'));
		require_once(__DIR__.'/../vendor/Google/autoload.php');
		spl_autoload_register(array('YiiBase','autoload'));

		$client = new Google_Client();
		$client->setApplicationName("My Calendar");
		$client->setDeveloperKey('AIzaSyDmdWqoy_X1znGv_WW4xp1F84-eUjgnqiw');

		$cal = new Google_Service_Calendar($client);
		$calendarId = 't1kogqff97immvd7rrc058flu8@group.calendar.google.com';
		$params = array(
			//CAN'T USE TIME MIN WITHOUT SINGLEEVENTS TURNED ON,
			//IT SAYS TO TREAT RECURRING EVENTS AS SINGLE EVENTS
				'singleEvents' => true,
				'orderBy' => 'startTime',
				'timeMin' => date(DateTime::ATOM), //ONLY PULL EVENTS STARTING TODAY
				'timeMax' => date(DateTime::ATOM,time()+(60*60*24*7*2)), // UP TO TWO WEEKS AWAY
			//OF EVENTS DISPLAYED

		);
		$events = $cal->events->listEvents($calendarId, $params);
		$calTimeZone = $events->timeZone; //GET THE TZ OF THE CALENDAR

		//SET THE DEFAULT TIMEZONE SO PHP DOESN'T COMPLAIN. SET TO YOUR LOCAL TIME ZONE.
		date_default_timezone_set($calTimeZone);

		$returnEvents = [];

		foreach ($events->getItems() as $event) {
			$returnEvents[] = array(
				'title'=>$event->summary,
				'location'=>$event->location,
				'timeStart'=>strtotime($event->start->dateTime),
				'timeEnd'=>strtotime($event->end->dateTime)
			);
		}

		return $returnEvents;
	}
}