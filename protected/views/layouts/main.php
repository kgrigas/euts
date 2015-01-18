<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' />

	<?php
	Yii::app()->clientScript->registerLinkTag('shortcut icon', null, Yii::app()->request->baseUrl.'/images/logo.png');
	Yii::app()->clientScript->registerCssFile('//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css');
	Yii::app()->clientScript->registerCssFile('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/site.min.css');

	Yii::app()->clientScript->registerScriptFile('//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js');
	Yii::app()->clientScript->registerScriptFile('//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/main.js');
	?>

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
				<li><a href="<?php echo Yii::app()->baseUrl.'/blog/'; ?>">Blog</a></li>
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

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-54350784-1', 'auto');
	ga('send', 'pageview');

</script>

</body>
</html>