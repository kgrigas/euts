<section class='gridRow'>

	<div class='col span12'>
		<h1 style='margin: 0;'>You are one form away from becoming one of our clients</h1>
		<p>After you fill out this form, we will contact you about your free, no-obligation valuation.<br />Just remember to fill out all the fields.</p>
	</div>
	<div class='clear'></div>
</section>

<section class='gridRow'>
	<div class='col span8' style='background: #F0F0F0; border: 1px solid #DDD; border-width: 1px 0;'>
		<?php
		$form=$this->beginWidget('CActiveForm', array(
			'enableClientValidation'=>true,
			'enableAjaxValidation'=>false,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			)
		));
		?>

			<div class='row gridRow'>
				<div class='col span2'>
					<?php echo $form->label($user, 'fName'); ?>
				</div>

				<div class='col span4'>
					<?php echo $form->textField($user, 'fName', array('class'=>'form-control'));?>
					<?php echo $form->error($user,'fName'); ?>
				</div>

				<div class='col span2'>
					<?php echo $form->label($user, 'sName'); ?>
				</div>

				<div class='col span4'>
					<?php echo $form->textField($user, 'sName', array('class'=>'form-control'));?>
					<?php echo $form->error($user,'sName'); ?>
				</div>
				<div class='clear'></div>
			</div>

			<div class='row gridRow'>
				<div class='col span2'>
					<?php echo $form->label($user, 'email'); ?>
				</div>

				<div class='col span4'>
					<?php echo $form->emailField($user, 'email', array('class'=>'form-control'));?>
					<?php echo $form->error($user,'email'); ?>
				</div>

				<div class='col span2'>
					<?php echo $form->label($user, 'phone'); ?>
				</div>

				<div class='col span4'>
					<?php echo $form->telField($user, 'phone', array('class'=>'form-control'));?>
					<?php echo $form->error($user,'phone'); ?>
				</div>
				<div class='clear'></div>
			</div>


			<div class='row gridRow'>
				<div class='col span2'>
					<?php echo $form->label($user, 'address'); ?>
				</div>
				<div class='col span10'>
					<?php echo $form->textArea($user, 'address', array('class' => 'form-control'));?>
					<?php echo $form->error($user,'address'); ?>
				</div>
				<div class='clear'></div>
			</div>

			<div class='row gridRow'>
				<div class='col span2'>
					<?php echo $form->label($user, 'postcode'); ?>
				</div>
				<div class='col span10'>
					<?php echo $form->textField($user, 'postcode', array('class' => 'form-control'));?>
					<?php echo $form->error($user,'postcode'); ?>
				</div>
				<div class='clear'></div>
			</div>




			<?php echo CHtml::label('Leave this empty','honeypot',array('style'=>'visibility: hidden; display: none;')); ?>
			<?php echo CHtml::textField('honeypot','',array('style'=>'visibility: hidden; display: none;'))?>

			<div class="buttons row" style='text-align: center; margin: 2em 0 1em;'>
				<?php echo CHtml::submitButton('Request Valuation Now', array('class'=>'button orange')); ?><br />
				<?php //echo CHtml::link('Privacy policy',array('site/page','view'=>'privacy'),array('target'=>'_new')); ?>
			</div>

		<?php $this->endWidget('CActiveForm'); ?>
	</div>

	<div class='col span4'>
		<div>
			<span style='font-family: "Alfa Slab One"; color: #D27721; font-size: 2em; text-shadow: 1px 1px 1px #666;'>&pound;595<sup style='text-shadow: 1px 1px 1px #666;'>+VAT</sup></span><br />
			<span style='font-family: "Alfa Slab One"; font-size: 1.2em;'>Any House, Any Value. Only when we sell</span>
		</div>

		<div style='margin-top: 1em; padding-top: 1em; border-top: 1px dashed #DDD;'>
			<span style='font-family: "Alfa Slab One"; color: #D29B21; font-size: 2em; text-shadow: 1px 1px 1px #666;'>ESPC</span><br />
			<span style='font-family: "Alfa Slab One"; font-size: 1.2em;'>Member of ESPC</span>
		</div>

		<div style='margin-top: 1em; padding-top: 1em; border-top: 1px dashed #DDD;'>
			<span style='font-family: "Alfa Slab One"; color: #D23221; font-size: 2em; text-shadow: 1px 1px 1px #666;'>WOW!</span><br />
			<span style='font-family: "Alfa Slab One"; font-size: 1.2em;'>Fixed Price Estate Agency</span>
		</div>
	</div>

	<div class='clear'></div>
</section>