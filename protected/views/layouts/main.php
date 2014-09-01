<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' />

	<?php
	Yii::app()->clientScript->registerLinkTag('shortcut icon', null, Yii::app()->request->baseUrl.'/images/logo.png');
	Yii::app()->clientScript->registerCssFile('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/site.min.css');


	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerScriptFile('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/main.js');
	?>

	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

	<meta name="viewport" content="initial-scale=1, maximum-scale=1">

</head>

<body>

<nav class="navbar-inverse navbar-fixed-top navbar" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#section1">
				<img id="logo" src="<?php echo Yii::app()->baseUrl; ?>/images/logo.png" alt=""> EUTS</a>
		</div>
		<div id="w0-collapse" class="collapse navbar-collapse">
			<ul id="w1" class="navbar-nav navbar-right nav">
				<li><a href="#section2">Beginners</a></li>
				<li><a href="#section3">Classes</a></li>
				<li><a href="#section4">Contacts</a></li>
			</ul>
		</div>
	</div>
</nav>


	<div class="wrap">
		<?php echo $content;?>
	</div>
<footer class="text-center">
	&#169; <?php echo date("Y"); ?> Edinburgh University Tango Society
</footer>

</body>
</html>