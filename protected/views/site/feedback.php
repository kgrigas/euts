<?php
Yii::app()->clientScript->registerCssFile('https://fonts.googleapis.com/css?family=Droid+Serif:400,700');
Yii::app()->clientScript->registerScript("autoresize","
		$('textarea').each(function () {
		  this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
		}).on('input', function () {
		  this.style.height = 'auto';
		  this.style.height = (this.scrollHeight) + 'px';
		});
");
?>

<div id="feedback_form">
	<form method="post" action="/feedback">
		<label for="feedback">What do you think about our last milonga?</label>
		<textarea name="feedback" id="feedback" placeholder="Type your answer" autofocus></textarea>
		<input type="submit" value="Submit" />
	</form>
</div>
<div id="feedback_footer">
	Edinburgh University Tango Society, <?php echo date("Y"); ?>
</div>