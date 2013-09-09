jQuery(function() {

	jQuery('.cubetech-icon-facts-button').click(function(){
		if(jQuery(this).parent().parent().find('.cubetech-icon-facts-content').text().length > 0) {
			jQuery(this).parent().parent().find('.cubetech-icon-facts-content').slideToggle(200);
		}
		jQuery(this).find('.more').fadeToggle(50);
		jQuery(this).find('.less').fadeToggle(50);
		return false;
	});
	
});