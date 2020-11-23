var nn = jQuery.noConflict();
nn(document).ready(function(){
	//Setup the main rotater on the home page
	nn('#slider').cycle({
	speed:       1200,
	timeout:     4000,
	pager:		'.slider_btn ul',
	pagerEvent: 'click',
	fastOnEvent: false
	});
});
