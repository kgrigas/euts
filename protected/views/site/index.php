<?php
/**
 * @var $news Array
 * @var $this SiteController
 * @var $blogPost WPPosts
 */
$this->pageTitle = 'Edinburgh University Tango Society';
?>

<div id="section1_wrapper">
<section id="section1">

	<video autoplay loop poster="<?php echo Yii::app()->baseUrl; ?>/images/video.jpg">
		<source src="<?php echo Yii::app()->baseUrl; ?>/videos/section1.mp4" type="video/mp4" />
	</video>

	<div id="section1_inside">
		<h1>Dance. Talk. Enjoy.</h1>


		<nav>
			<h2>Edinburgh University Tango Society</h2>
			<a class="button right" href="https://www.facebook.com/groups/eutangosociety/">Facebook</a>
<!--			<a class="button right" href="#">Newsletter</a>-->
		</nav>

		<div class="news">
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
					echo '<h3>'.date('l', $singleNews['timeStart']).'<span class="smaller"> '.date('M d', $singleNews['timeStart']).'</span></h3>';
				}

				if (Yii::app()->format->location($singleNews['location']) !== $previousEvent['location']) {
					echo '<h5>'.Yii::app()->format->location($singleNews['location']).'</h5>';
				}
				echo '<h4>'.Yii::app()->format->time($singleNews['timeStart']).' - '.Yii::app()->format->time($singleNews['timeEnd']).'&nbsp;&nbsp;'.$singleNews['title'].'</h4>';
				$previousEvent = array(
					'day' => date('N', $singleNews['timeStart']),
					'location' => Yii::app()->format->location($singleNews['location'])
				);
			}
			echo "</div>"; //Close the day
			?>
			<a href="http://goo.gl/xnsfCS" id="calendar_link">Full calendar <i class="fa fa-angle-right"></i></a>
		</div>
	</div>

<!--				<div class="blog">
					<h4 class="title">Latest blog entry</h4>
					<h3><?php /*echo CHtml::link($blogPost->post_title.' <i class="fa fa-angle-right"></i>',$blogPost->guid); */?></h3>
					<h5><?php /*echo Yii::app()->format->datetime(strtotime($blogPost->post_date)); */?></h5>
				</div>-->
	</div>
</section>
</div>

<section id="section2">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-push-2">
				<div class="text">
					<p>Hola Tangueras and Tangueros!</p>
					<p>Forget the Strictly Come Dancing ballroom tango of stiff postures and roses between teeth! This is Argentine tango – where every dance is different; where you form the most incredible of connections; where you never stop learning and where a whole world-wide community awaits you. And at your fingertips, at minimal cost, EUTS can take you there with some of the best teachers around, a laid back atmosphere and a host of social events nearly every day of the week.</p>
					<p>In the words of Margaret Putnam: “Tango is the Everest of social dance. Impossible. Demanding. Intricate. And therefore irresistible.”</p>
					<p>Wishing you the best,<br />
						EUTS Committee</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!--<section id="section3">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<h1 style="font-size: 2.5em; margin-bottom: 1.25em;">Classes &amp; Practicas</h1>
				<div class="weekday">
					<h1><span class="bolder">Monday</span> practica with Jenny &amp; Ricardo</h1>
					<h2>The Counting House</h2>
					<div class="item">
						<h3><span class="bolder">8:05pm - 8:30pm</span> Core Session</h3>
						<p>A short session focused on core Tango techniques. It awesome, and it comes for free if you come to Rumbos studio night!</p>
					</div>
					<div class="item">
						<h3><span class="bolder">8:30pm - 10:30pm</span> Rumbos studio night</h3>
						<p>The best place to practice technique, connection and improvisation skills, all under the supervision to one of the best Tango dancers in UK. (&pound;3)</p>
					</div>
				</div>
				<div class="weekday">
					<h1><span class="bolder">Thursday</span> classes with Sarah</h1>
					<h2>The Merlin <a href="https://goo.gl/maps/9yLae" target="_blank"><i class="fa fa-map-marker"></i></a></h2>
					<div class="item">
						<h3><span class="bolder">7:30pm-8:45pm</span> Beginners</h3>
						<p>For those making their first steps in Tango (&pound;4)</p>
					</div>
					<div class="item">
						<h3><span class="bolder">8:50pm-10:00pm</span> Improvers</h3>
						<p>For those who want to excel at their dance (&pound;4)</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>-->

<section id="section4">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<div class="text">
					<h1>Contacts</h1>

					<i class="fa fa-fw fa-lg fa-envelope"></i> Email us at <a href="mailto:tangosoc@googlemail.com">tangosoc@googlemail.com</a><br />
					<i class="fa fa-fw fa-lg fa-facebook-square"></i> Find us on <a href="https://www.facebook.com/groups/eutangosociety/" target="_blank">Facebook</a>

					<h3>EUTS Committee</h3>
					<ul>
						<li><strong>President</strong> - Teresa Spanò</li>
						<li><strong>Vice President</strong> - Nevena Kostova</li>
						<li><strong>Treasurer</strong> - Yavor Panev</li>
						<li><strong>Secretary</strong> - Filip Margetiny</li>
						<li><strong>Social Secretary</strong> - Konstanze Simbriger</li>
						<li><strong>Public Relations</strong> - Lana Sverejeva-Hopkins</li>
						<li><strong>KB Executive</strong> - Igor Krylov</li>
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