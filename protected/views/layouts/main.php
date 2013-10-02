<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet'>
	<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700' rel='stylesheet'>
	<link href='http://fonts.googleapis.com/css?family=Alfa+Slab+One' rel='stylesheet'>

	<?php
	Yii::app()->clientScript->registerLinkTag('shortcut icon', null, Yii::app()->request->baseUrl.'/favicon.ico');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/main.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/font-awesome.min.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/gridpak.css');

	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/mr.js',CClientScript::POS_END);
	?>

	<!--[if lt IE 9]>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5shiv.js"></script>
	<![endif]-->

	<?php if (!isset(Yii::app()->params['enableAnalytics']) || Yii::app()->params['enableAnalytics'] == true): ?>
		<script>
			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', 'UA-7553822-4']);
			  _gaq.push(['_trackPageview']);

			  (function() {
			    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();
		</script>
	<?php endif; ?>
</head>

<body>
	<header>
		<div class='content'>
			<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/img/logoFull.png','',array('style'=>'float: left;')),array('site/index')); ?>

			<nav id="mainmenu">
				<?php
				$this->widget('zii.widgets.CMenu',array(
					'encodeLabel'=>false,
					'items'=>array(
						array('label'=>'Home', 'url'=>array('site/index')),
						array('label'=>'Selling', 'url'=>array('site/page','view'=>'selling')),
						array('label'=>'About', 'url'=>array('site/page','view'=>'about')),
						//array('label'=>'Architecture & Self-Build ', 'url'=>''),
					),
				)); ?>
				<div class='clear'></div>
			</nav>
		</div>
	</header>

	<div class='content' id='page'>
		<?php echo $content; ?>
	</div>
	<div class="clear"></div>


	<footer class='content gridRow'>
		<div style='text-align: center;'>
			Copyright &copy; Move Right 2013
		</div>
	</footer>

	<!-- AddThis Smart Layers BEGIN -->
	<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52303e4822c93a4a"></script>
	<script type="text/javascript">
		addthis.layers({
			'theme' : 'transparent',
			'share' : {
				'position' : 'left',
				'numPreferredServices' : 5
			}
		});
	</script>
	<!-- AddThis Smart Layers END -->


</body>
</html>