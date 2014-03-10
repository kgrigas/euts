<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/property.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.cycle2.min.js'); ?>

<section>
	<div class='col-sm-8'>
		<div id='deluxeSlides'>
			<?php
			foreach($property->images as $image) {
				echo CHtml::image("http://www.baysoft-web.co.uk/bsImages/PropertyImages/".$image->name,'',array('class'=>'slide responsive'));
			}
			?>
			<?php if(sizeof($property->images) > 1): ?>
				<div class="homeFeaturedPrev cycle-previous"><i class='fa fa-chevron-circle-left fa-2x'></i></div>
				<div class="homeFeaturedNext cycle-next"><i class='fa fa-chevron-circle-right fa-2x'></i></div>
			<?php endif; ?>
		</div>
	</div>
	<div class='col-sm-4'>
		<section class='propertyAddress'>
			<h2><?php echo $property->address;?></h2>
			<?php echo $property->postcode;?><br />
			<span style='font-style: italic;'>"<?php echo $property->spec->summary;?>"</span>
			<div class='borderGrey'></div>
		</section>
		<strong><?php echo $property->finance->priceType;?><strong> &pound;<?php echo $property->finance->price;?>
		<div class='borderGrey'></div>
		<strong>Bedrooms: </strong> <?php echo $property->spec->bedrooms;?><br />
		<strong>Public Rooms: </strong> <?php echo $property->spec->publicRooms;?><br />
		<strong>Bathrooms: </strong> <?php echo $property->spec->bathrooms;?> <br />

		<?php echo CHtml::link('<i class="fa fa-download"></i> Request Home Report',array('properties/view','id'=>$property->id), array('class'=>'button right blue')); ?>
		<div class='clear'></div>
		<?php echo CHtml::link('<i class="fa fa-download"></i> Request Schedules',array('properties/view','id'=>$property->id), array('class'=>'button right orange')); ?>
		<div class='clear'></div>
	</div>
	<div class='clear'></div>
	<div class='borderGrey'></div>
	<h2>Property Description</h2>
	<p style='font-weight: normal;'><?php echo $property->spec->description;?></p>
</section>