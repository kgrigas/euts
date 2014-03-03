$(function(){
	'use strict';
	if ($('#deluxeSlides').length) {
		$('#deluxeSlides').cycle({
	        fx:     'fade',
	        speed: 	'slow',
	        timeout: 10000,
			pause: false,
			slideExpr: '.slide',
			next:   '.homeFeaturedNext',
			pauseOnHover: '#propertyThumbnailStrip',
			prev:   '.homeFeaturedPrev',
	    });
	}
});
