<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Rokkitt:400,700|Alfa+Slab+One' rel='stylesheet' />

	<?php
	Yii::app()->clientScript->registerLinkTag('shortcut icon', null, Yii::app()->request->baseUrl.'/favicon.ico');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/gridpak.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/font-awesome.min.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/main.css');


	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap.js');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/mr.js',CClientScript::POS_END);
	?>

	<!--[if lt IE 9]>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5shiv.js"></script>
	<![endif]-->

	<?php if (!isset(Yii::app()->params['enableAnalytics']) || Yii::app()->params['enableAnalytics'] == true): ?>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-7553822-8', 'moveright.co.uk');
			ga('send', 'pageview');

		</script>
	<?php endif; ?>
</head>

<body>
	<header>
		<div class='content'>
			<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/img/logoFull4.png','',array('style'=>'float: left;')),array('site/index')); ?>

			<nav id="mainmenu">
				<?php
				$this->widget('zii.widgets.CMenu',array(
					'encodeLabel'=>false,
					'items'=>array(
						array('label'=>'Home', 'url'=>array('site/index')),
						array('label'=>'Selling', 'url'=>array('site/page','view'=>'selling')),
						array('label'=>'Enquire ', 'url'=>array('site/enquire')),
						array('label'=>'About', 'url'=>array('site/page','view'=>'about')),
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
	<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52303e4822c93a4a"></script>
	<script>
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