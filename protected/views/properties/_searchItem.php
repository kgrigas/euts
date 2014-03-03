<div class='propertyItem infoBlock'>
	<div class='col-sm-3'>
		<?php echo CHtml::image(Yii::app()->baseUrl.'/img/properties/small/'.$data->smallImage->fileName,'',array('class' => 'responsive'));?>
	</div>
	<div class='col-sm-9'>
		<div class='col-sm-9 propertyInfo'>
			<span style='font-weight: bold;'><?php echo CHtml::link($data->address, array('properties/view','id'=>$data->id)); ?></span><br />
			Beds: <?php echo $data->bedrooms;?>, Public Rooms: <?php echo $data->publicRooms;?>, Bathrooms: <?php echo $data->bathrooms;?> <br />
		</div>
		<div class='col-sm-3 propertyInfo' style='font-weight: bold; text-align: right;'>
			<?php echo $data->priceType;?> &pound;<?php echo $data->price;?> <br />		
		</div>
		<div class='clear'></div> 
		<div class='borderGrey'></div>
		<div id='summary'>
			<?php echo $data->summary;?>		
		</div>
		<?php echo CHtml::link('View Details <i class="fa fa-caret-right"></i>',array('properties/view','id'=>$data->id), array('class'=>'button right blue')); ?>
		<div class='clear'></div>
	</div>
	<div class='clear'></div>
</div>