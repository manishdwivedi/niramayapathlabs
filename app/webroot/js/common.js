
$(function(){
	/**
	  * Javascript Tab Code 
	  * Copyright David Baker (dtbaker@gmail.com)
	  * Created for ThemeForest theme Nov 2009
	  */
	var current_tab = 1; // start with first tab.
	var tab_count = 1; // loop counter.
	var tab_auto = 0; // how many seconds to wait for auto scroll
	// first name each of our tab contents.
	$('#tab_content li').each(function(){
		$(this).attr('rel',tab_count);
		if(tab_count != current_tab)$(this).hide(); // hide all that are not current.
		else $(this).show();
		tab_count++;
	});
	tab_count = 1;
	// bind the clicks.
	function tab_gogo(this_tab_id){
		// find an existing tab, fade it out.
		var tab = $('#home_tabs li a[rel='+this_tab_id+']');
		if(current_tab){
			if($.browser.msie)$('#tab_content li[rel=' + current_tab + ']').hide();
			else $('#tab_content li[rel=' + current_tab + ']').fadeOut();
		}
		// find the tab to display... fade it in.
		if($.browser.msie)$('#tab_content li[rel=' + this_tab_id + ']').show();
		else $('#tab_content li[rel=' + this_tab_id + ']').fadeIn();
		// remove any old current list items.
		$('#home_tabs li.current').removeClass('current');
		// change the state of the holding li item to current for styling.
		$(tab).parent('li').addClass('current');
		current_tab = this_tab_id;
	}
	$('#home_tabs li a').each(function(){
		// each of the a links, find it's count and set a callback on the a link.
		$(this).attr('rel',tab_count);
		// just for first time loading.
		if(tab_count == current_tab)$(this).parent('li').addClass('current'); 
		$(this).click(function(){
			var this_tab_id = $(this).attr('rel');
			tab_auto = 0;
			tab_gogo(this_tab_id);
			return false;
		});
		tab_count++;
  	});
	if(tab_auto){
		function tab_auto_gogo(){
			if(!tab_auto)return;
			// how many tabs are there.
			var this_current = current_tab;
			if(this_current >= $('#home_tabs li a').size())this_current = 1;
			else this_current++;
			tab_gogo(this_current); //$('#home_tabs li a[rel='+this_current+']').click();
			setTimeout(tab_auto_gogo,tab_auto*1000);
		}
		setTimeout(tab_auto_gogo,tab_auto*1000);
	}
});
