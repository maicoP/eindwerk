

jQuery(document).ready(function($){
	
	/* ---------- Add class .active to current link  ---------- */
	$('ul.main-menu li a').each(function(){
		
			if($($(this))[0].href==String(window.location)) {
				
				$(this).parent().addClass('active');
				
			}
	
	});
	
	$('ul.main-menu li ul li a').each(function(){
		
			if($($(this))[0].href==String(window.location)) {
				
				$(this).parent().addClass('active');
				$(this).parent().parent().show();
				
			}
	
	});
	
});	