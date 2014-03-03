<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Rokkitt:400,700|Alfa+Slab+One' rel='stylesheet' />

	<?php
	Yii::app()->clientScript->registerLinkTag('shortcut icon', null, Yii::app()->request->baseUrl.'/favicon.ico');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/gridpak.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/3rd-party/font-awesome.min.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/main.css');


	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap.js');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.cycle2.min.js');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/mr.js',CClientScript::POS_END);
	?>

	<!--[if lt IE 9]>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5shiv.js"></script>
	<![endif]-->

</head>

<body>
	<div class='col-lg-1'></div>
	<div class='col-lg-10 col-xs-12 col-md-12'>
		<header>
			<div class='left'>
				<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/img/the-chamber-practice.png','',array('style' => 'max-width: 200px;')), Yii::app()->baseUrl);?>
			</div>
			<div class='right'>
				<div class='contactNumber'>CALL: <span class='color'>0131 603 5505</span><br />
					<span style='font-size: 0.8em;'>www.MovRight.com</span>
				</div>
				<nav id="mainmenu">
					<?php
					$this->widget('zii.widgets.CMenu',array(
						'encodeLabel'=>false,
						'items'=>array(
							array('label'=>'Home', 'url'=>array('site/index')),
							array('label'=>'Selling', 'url'=>array('site/page','view'=>'selling')),
							array('label'=>'Properties For Sale', 'url'=>array('properties/search')),
							array('label'=>'Enquire ', 'url'=>array('site/enquire')),
							array('label'=>'About', 'url'=>array('site/page','view'=>'about')),
						),
					)); ?>
					<div class='clear'></div>
				</nav>
				<div class='mobileMenu'>
					CALL: 0131 603 5505
				</div>
			</div>
			<div class='clear'></div>
		</header>
		<div>
			<div class='col-md-3'>
				<div class='leftCol'>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'action'=>Yii::app()->createUrl('properties/search'),
					'method'=>'post',
					'htmlOptions'=>array(
					),
				)); ?>
					<h2 style='margin-top: 0;'>Property Search</h2>
					<div class='row'>
						<?php echo CHtml::label('Location','location')?>
						<?php echo CHtml::textField('location', '', array('class'=>'form-control')); ?>
					</div>
					<div class='row'>
						<?php echo CHtml::label('Bedrooms','bedroomsMin')?>
						<?php echo CHtml::dropDownList('bedroomsMin', 0, array(0=>'Any', 1=>1, 2=>2, 3=>3, 4=>4, 5=>'5+'), array('class'=>'form-control')); ?>
					</div>
					<div class='row'>
						<?php echo CHtml::label('Max Price','maxPrice')?>
						<?php echo CHtml::numberField('maxPrice', 1500000, array('class'=>'form-control', 'step'=>'25000')); ?>
					</div>

					<div style='text-align: center;'>
						<?php echo CHtml::link('Search',array('properties/search'),array('style'=>'display: block; text-align: center; margin: 1em 0;', 'class'=>'button orange')); ?>
					</div>
					<?php $this->endWidget(); ?>
					<div class='border'></div>

					<h2>Selling Your Property</h2>
					<p>The Chamber Practice is a low cost Estate Agents, if you are interested in selling with us, enquire below.</p>
					<?php echo CHtml::link('Enquire Now',array('site/enquire'),array('style'=>'display: block; text-align: center; margin: 1em 0;', 'class'=>'button blue')); ?>
					<div class='border'></div>

					<h2>Featured Property</h2>
					<?php echo CHtml::image('https://www.mcewanfraserlegal.co.uk/img/properties/640x480/MFL112805_91.jpg','',array('style' => 'width: 100%;'));?>
					<div class='propertyDescription'>
					<?php $featured = Properties::Model()->findByAttributes(array('featured' => 1));?>
					<p><?php echo $featured->address;?><p>
					<p><?php echo $featured->priceType.' - &pound;'.$featured->price;?></p>
					<p><?php echo CHtml::link('More information..', array('properties/view', 'id' => $featured->id),array('style' => 'color: #1e0fbe;'));?></p>
					</div>
				</div>
			</div>
			<div class='col-md-9'><div class='mainContainer'><?php echo $content;?></div></div>
			<div class='clear'></div>
		</div>

	</div>
	<div class='col-lg-1'></div>
	<div class='clear'></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by The Chamber Practice<br/>
		The Chamber Practice, Solicitors and Estate Agents <br />
		www.MovRight.com
	</div>
</body>
</html>