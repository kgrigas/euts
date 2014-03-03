<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/property.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.cycle2.min.js'); ?>

<section>
	<div class='col-sm-8'>
		<div id='deluxeSlides'>
			<?php
				if(!empty($property->images)){
					foreach($property->images as $image){
						echo CHtml::image(Yii::app()->baseUrl.'/img/properties/large/'.$image->fileName, '', array('class' => 'slide responsive'));
					}
				}
			?>
			<div class="homeFeaturedPrev cycle-previous"><i class='fa fa-chevron-circle-left fa-2x'></i></div>
			<div class="homeFeaturedNext cycle-next"><i class='fa fa-chevron-circle-right fa-2x'></i></div>
		</div>
	</div>
	<div class='col-sm-4'>
		<section class='propertyAddress'>
			<h2><?php echo $property->address;?></h2>
			<?php echo $property->postcode;?><br />
			<span style='font-style: italic;'>"<?php echo $property->summary;?>"</span>
			<div class='borderGrey'></div>
		</section>
		<strong><?php echo $property->priceType;?><strong> &pound;<?php echo $property->price;?>
		<div class='borderGrey'></div>
		<strong>Bedrooms: </strong> <?php echo $property->bedrooms;?><br />
		<strong>Public Rooms: </strong> <?php echo $property->publicRooms;?><br />
		<strong>Bathrooms: </strong> <?php echo $property->bathrooms;?> <br />
		
		<?php echo CHtml::link('<i class="fa fa-download"></i> Request Home Report',array('properties/view','id'=>$property->id), array('class'=>'button right blue')); ?>
		<div class='clear'></div>
		<?php echo CHtml::link('<i class="fa fa-download"></i> Request Schedules',array('properties/view','id'=>$property->id), array('class'=>'button right orange')); ?>		
		<div class='clear'></div>
	</div>
	<div class='clear'></div>
	<div class='borderGrey'></div>
	<h2>Property Description</h2>
	<p style='font-weight: normal;'><?php echo $property->description;?></p>
</section>