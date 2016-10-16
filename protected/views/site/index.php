<?php
/**
 * @var $news array
 * @var $this SiteController
 * @var $blogPost WPPosts
 */
$this->pageTitle = 'Edinburgh University Tango Society';
?>
<div class="wrap">
<section id="section1">
	<video autoplay loop poster="<?php echo Yii::app()->baseUrl; ?>/images/video.jpg">
		<source src="<?php echo Yii::app()->baseUrl; ?>/videos/section1.mp4" type="video/mp4" />
	</video>

	<div id="section1_inside">
		<!--<h1 class="full">Do you want to be surrounded by the passion and the drama of authentic Argentine Tango?</h1>-->
		<h1 class="full">Hello. This is</h1>
		<h1 class="mobile">Hello. This is</h1>
		<h2>Edinburgh University Tango Society</h2>
		<div id="arrow"><a href="#section3"><i class="fa fa-angle-down"></i></a></div>
	</div>
</section>
<section id="section3">
	<div class="container">
		<div class="news">
			<h2>Calendar</h2>
			<p>
				We run weekly classes, three days a week, with three different teachers. That's a lot of Tango. Check it.
			</p>

			<?php
			$previousEvent = array(
				'day'=>null,
				'location'=>null
			);
			foreach ($news as $singleNews) {
				if (date('N',$singleNews['timeStart']) !== $previousEvent['day']) {
					if ($previousEvent['day'] !== null) {
						echo '</div>';
					}
					echo '<div class="day">';
					echo '<h3>'.date('l', $singleNews['timeStart']).'<span class="smaller"> '.date('F d', $singleNews['timeStart']).'</span></h3>';
				}

				if (Yii::app()->format->location($singleNews['location']) !== $previousEvent['location']) {
					echo '<h5>'.Yii::app()->format->location($singleNews['location']).'</h5>';
				}
				echo '<h4>'.Yii::app()->format->time($singleNews['timeStart']).' - '.Yii::app()->format->time($singleNews['timeEnd']).'<span class="title">'.$singleNews['title'].'</span></h4>';
				$previousEvent = array(
					'day' => date('N', $singleNews['timeStart']),
					'location' => Yii::app()->format->location($singleNews['location'])
				);
			}
			echo "</div>"; //Close the day
			?>
			<a href="http://goo.gl/xnsfCS" id="calendar_link">Full calendar</a>
		</div>
	</div>
</section>
<section id="section2">
	<div class="container">
		<h2>Blog</h2>

		<p>Occasionally our members of the society have something to say. These are valuable words.</p>

		<?php foreach ($blogPosts as $blogPost) { ?>
			<div class="blog">
				<h3><?php echo CHtml::link($blogPost->post_title.' <i class="fa fa-angle-right"></i>',$blogPost->guid);?></h3>
				<!--<h5><?php echo Yii::app()->format->datetime(strtotime($blogPost->post_date));?></h5>-->
			</div>
		<?php } ?>

		<!--<div class="row">
			<div class="col-xs-12 col-md-8 col-md-push-2">
				<div class="text">
					<p>Hola Tangueras and Tangueros!</p>
					<p>Forget the Strictly Come Dancing ballroom tango of stiff postures and roses between teeth! This is Argentine tango – where every dance is different; where you form the most incredible of connections; where you never stop learning and where a whole world-wide community awaits you. And at your fingertips, at minimal cost, EUTS can take you there with some of the best teachers around, a laid back atmosphere and a host of social events nearly every day of the week.</p>
					<p>In the words of Margaret Putnam: “Tango is the Everest of social dance. Impossible. Demanding. Intricate. And therefore irresistible.”</p>
					<p>Wishing you the best,<br />
						EUTS Committee</p>
				</div>
			</div>
		</div>-->
	</div>
</section>
<section id="section4">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<div class="text">
					<h2>Contacts</h2>

					<i class="fa fa-fw fa-lg fa-envelope"></i> Email us at <a href="mailto:tangosoc@googlemail.com">tangosoc@googlemail.com</a><br />
					<i class="fa fa-fw fa-lg fa-facebook-square"></i> Find us on <a href="https://www.facebook.com/groups/eutangosociety/" target="_blank">Facebook</a>

					<h3>EUTS Committee</h3>
					<ul>
						<li><strong>President</strong> - Konstanze Simbriger</li>
						<li><strong>Vice President</strong> - Yavor Panev</li>
						<li><strong>Treasurer</strong> - Abel Arredondo</li>
						<li><strong>Secretary</strong> - Paul Piho</li>
						<li><strong>Social Secretary</strong> - Lilinaz Rouhani</li>
						<li><strong>Public Relations</strong> - Maria Ustinova</li>
						<li><strong>KB Executive</strong> - Savvas Kourtis</li>
						<li><strong>IT</strong> - Karolis Grigas</li>
					</ul>

					<h3>Credits</h3>
					<ul>
						<li><strong>Videography</strong> - <a href="http://www.filmsbyben.com/" target="_blank">Ben Price / filmsbyben</a></li>
					</ul>

				</div>
			</div>
			<div class="col-xs-12 col-md-4 col-sm-push-4">
			</div>
		</div>
	</div>
</section>
</div>
<footer class="text-center">
	&#169; <?php echo date("Y"); ?> Edinburgh University Tango Society
</footer>