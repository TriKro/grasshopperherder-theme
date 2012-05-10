jQuery(document).ready(function(){
    jQuery(".entry-content p > a:has(img)").addClass("noborder");

	jQuery('ul.menu > li').hover(
		function(){
			if( jQuery(this).find('ul.sub-menu').length > 0 ) {
				jQuery(this).children('ul.sub-menu').show();
				jQuery(this).addClass('hovered');
			}
		},
		function(){
			jQuery(this).children('ul.sub-menu').hide();
			jQuery(this).removeClass('hovered');
		}
	);
});