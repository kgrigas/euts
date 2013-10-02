<?php
$this->pageTitle='404: Page Not Found';
$this->breadcrumbs=array(
	'Error',
);
?>

<h1>Page Not Found</h1>
<p>The page you requested is no longer available, or cannot be found. Please double-check the URL (address) you used, or <?php echo CHtml::link('contact us', array('site/contact')); ?> if you feel you have reached this page in error.</p>

<p><strong>Click the 'Back' button on your browser or <?php echo CHtml::link('go to the homepage', array('site/index')); ?>.</strong></p>

<p><strong>Are you looking for any of these features?</strong></p>
<ul>
	<li><?php echo CHtml::link('Homepage', array('site/index')); ?></li>
	<li><?php echo CHtml::link('Property Search', array('properties/search/')); ?></li>
	<li><?php echo CHtml::link('Selling', array('site/selling')); ?></li>
	<li><?php echo CHtml::link('Buying', array('site/buying')); ?></li>
	<li><?php echo CHtml::link('Part-Exchange', array('site/partExchange')); ?></li>
	<li><?php echo CHtml::link('Sucess Stories', array('media/testimonials')); ?></li>
	<li><?php echo CHtml::link('Recruitment', array('site/page','view'=>'recruitment')); ?></li>
</ul>