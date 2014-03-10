<div class='propertyItem infoBlock'>
	<div class='col-sm-3'>
		<?php echo CHtml::image("http://www.baysoft-web.co.uk/bsImages/PropertyImages/".$data->images[0]->name,'',array('class'=>'responsive')); ?>
	</div>
	<div class='col-sm-9'>
		<div class='col-sm-9 propertyInfo'>
			<span style='font-weight: bold;'><?php echo CHtml::link($data->address, array('property/view','id'=>$data->id)); ?></span><br />
			Beds: <?php echo $data->spec->bedrooms;?>, Public Rooms: <?php echo $data->spec->publicRooms;?>, Bathrooms: <?php echo $data->spec->bathrooms;?> <br />
		</div>
		<div class='col-sm-3 propertyInfo' style='font-weight: bold; text-align: right;'>
			<?php echo $data->finance->priceType.' '.Yii::app()->format->currency($data->finance->price); ?> <br />
		</div>
		<div class='clear'></div>
		<div class='borderGrey'></div>
		<div id='summary'>
			<?php echo $data->spec->summary;?>
		</div>
		<?php echo CHtml::link('View Details <i class="fa fa-caret-right"></i>',array('property/view','id'=>$data->id), array('class'=>'button right blue')); ?>
		<div class='clear'></div>
	</div>
	<div class='clear'></div>
</div>