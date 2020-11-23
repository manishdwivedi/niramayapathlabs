j(document).ready(function() {
	j("#logoParade").smoothDivScroll({ 
		autoScrollingMode: "always", 
		autoScrollingDirection: "endlessLoopRight", 
		autoScrollingStep: 1, 
		autoScrollingInterval: 25 
	});

	// Logo parade event handlers
	j("#logoParade").bind("mouseover", function() {
		$(this).smoothDivScroll("stopAutoScrolling");
	}).bind("mouseout", function() {
		$(this).smoothDivScroll("startAutoScrolling");
	});
});

j(window).load(function(){
	j('.logoParade.outer').css('opacity', '1');
});