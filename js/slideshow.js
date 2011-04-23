// jQuery Cycle script which powers the Slideshow: http://jquery.malsup.com/cycle/

var $j = jQuery.noConflict();

var $slidespeed = parseInt( meteorslidessettings.meteorslideshowspeed );

var $slidetimeout = parseInt( meteorslidessettings.meteorslideshowduration );

var $slideheight = parseInt( meteorslidessettings.meteorslideshowheight );

var $slidewidth = parseInt( meteorslidessettings.meteorslideshowwidth );

var $slidetransition = meteorslidessettings.meteorslideshowtransition;

$j(document).ready(function() {
	
    $j('.meteor-slides').cycle({
	
		height: $slideheight,
		width: $slidewidth,
		fit: '1',
		fx: $slidetransition,
		speed: $slidespeed,
		timeout: $slidetimeout,
		pause: '1',
		prev: '#meteor-prev',
		next: '#meteor-next',
		pager: '#meteor-buttons',
		pagerEvent: 'click',
		cleartypeNoBg: 'true',
		slideExpr: '.mslide'
		
	});

});