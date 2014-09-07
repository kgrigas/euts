<?php
/**
 * @var $news Array
 * @var $this SiteController
 * @var $blogPost WPPosts
 */
$this->pageTitle = 'Edinburgh University Tango Society';
?>

<section id="section1">

	<video autoplay loop poster="<?php echo Yii::app()->baseUrl; ?>/images/video.jpg">
		<source src="<?php echo Yii::app()->baseUrl; ?>/videos/section1.mp4" type="video/mp4" />
	</video>

	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-xs-12">
				<h1>Dance. Talk. Enjoy.</h1>
				<h2>Edinburgh University Tango Society</h2>

				<nav>
					<a class="button" href="#section2">Information for beginners </a>
					<a class="highlight button" href="#section3">Times for Dancing</a>
				</nav>
			</div>
			<div class="col-sm-4 col-xs-12">

				<div class="news">
					<h4 class="title">Upcoming events</h4>

					<?php foreach ($news as $singleNews): ?>
						<h3><?php echo $singleNews['title']; ?></h3>
						<h5><?php echo Yii::app()->format->datetime($singleNews['time']); ?></h5>
						<h4><?php echo $singleNews['location']; ?></h4>
						<?php /*echo $singleNews['content'];*/ ?>
					<?php endforeach; ?>
				</div>

				<div class="blog">
					<h4 class="title">Latest blog entry</h4>
					<h3><?php echo CHtml::link($blogPost->post_title.' <i class="fa fa-angle-right"></i>',$blogPost->guid); ?></h3>
					<h5><?php echo Yii::app()->format->datetime(strtotime($blogPost->post_date)); ?></h5>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="section2">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<div class="text">
					<p>Hola Tangueras and Tangueros!</p>
					<p>Forget the Strictly Come Dancing ballroom tango of stiff postures and roses between teeth! This is Argentine tango – where every dance is different; where you form the most incredible of connections; where you never stop learning and where a whole world-wide community awaits you. And at your fingertips, at minimal cost, EUTS can take you there with some of the best teachers around, a laid back atmosphere and a host of social events nearly every day of the week.</p>
					<p>In the words of Margaret Putnam: “Tango is the Everest of social dance. Impossible. Demanding. Intricate. And therefore irresistible.”</p>
					<p>Also, don’t forget to check the <a href="#section3">calendar</a> for the latest changes in classes!</p>
					<p>Wishing you the best,<br />
						EUTS Committee</p>
				</div>
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="text freshers">
					<h1>Freshers' week 2014:</h1>
					<p>There are two taster classes during the freshers' week. You don't need dancing experience, nor a partner, just come and see what it feels like to dance Tango. We provide everything. Now pick your time:</p>
					<div class="weekday">
						<h1><span class="bolder">Wednesday, 10<sup>th</sup></span></h1>
						<h2>6:00pm - 7:30pm</h2>
						<h3>The Study, Teviot</h3>
						<div class="item">
							<p>Tango taster with our long running teacher Toby - no experience or partner needed.</p>
						</div>
					</div>
					<div class="weekday">
						<h1><span class="bolder">Saturday, 13<sup>th</sup></span></h1>
						<h2>12:00pm - 1:00pm</h2>
						<h3>The Study, Teviot</h3>
						<div class="item">
							<p>Another taster with Sarah - again, we provide everything you need.</p>
						</div>
					</div>
				</div>
			</div>
	</div>
</section>
<section id="section3">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<h1 style="font-size: 2.5em; margin-bottom: 1.25em;">Classes &amp; Practicas</h1>

				<div class="weekday">
					<h1><span class="bolder">Monday</span> classes with Sarah</h1>
					<h2>Pi in the sky, Kings Buildings House</h2>
					<div class="item">
						<h3><span class="bolder">5:30pm - 6:30pm</span> Beginners</h3>
						<p>To learn and re-learn the first steps</p>
					</div>
					<div class="item">
						<h3><span class="bolder">6:30pm - 7:30pm</span> Dancing and Technique</h3>
						<p>All levels welcome</p>
					</div>
				</div>
				<div class="weekday">
					<h1><span class="bolder">Tuesday</span> practica with Toby</h1>
					<h2>Debating Hall, Teviot</h2>
					<div class="item">
						<h3><span class="bolder">12:45pm-1:45pm</span> Practica</h3>
						<p>Get personal advice and use the dancefloor. And it's free!</p>
					</div>

					<h1><span class="bolder">Tuesday</span> classes with Brian & Julieta</h1>
					<h2>Debating Hall, Teviot</h2>
					<div class="item">
						<h3><span class="bolder">6:00pm-7:15pm</span> Intermediates</h3>
						<p>For those who dance for more than a year</p>
					</div>
					<div class="item">
						<h3><span class="bolder">7:15pm-8:30pm</span> Post-Beginners</h3>
						<p>For those with at least six months of experience</p>
					</div>
				</div>
				<div class="weekday">
					<h1><span class="bolder">Wednesday</span> practica with Toby</h1>
					<h2>Debating Hall, Teviot</h2>
					<div class="item">
						<h3><span class="bolder">12:45pm-1:45pm</span> Practica</h3>
						<p>Because one practica is not enought. Did we mentioned that it's free?</p>
					</div>


					<h1><span class="bolder">Wednesday</span> classes with Toby</h1>
					<h2>The Venue, Poterrow</h2>
					<div class="item">
						<h3><span class="bolder">6:00pm-7:00pm</span> Improvers</h3>
						<p>For those with experience or who want to improve faster</p>
					</div>
					<div class="item">
						<h3><span class="bolder">7:00pm-8:30pm</span> Beginners</h3>
						<p>For those making their first steps</p>
					</div>
					<div class="item">
						<p>Need more time to try out new things you learned? Stay after the class, since it is followed by <span class="bolder">unsupervised practica</span> (spacious dancefloor with music) <span class="bolder">until 9:30pm</span>!</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>

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
						<li><strong>President</strong> - Ivana Lapsanska</li>
						<li><strong>Vice President</strong> - Dimo Petroff</li>
						<li><strong>Treasurer</strong> - Erifili Efthymiadou</li>
						<li><strong>Secretary</strong> - Filip Margetiny</li>
						<li><strong>Social Secretary</strong> - Tania Marques</li>
						<li><strong>Public Relations</strong> - Paraskevi Papagianni</li>
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