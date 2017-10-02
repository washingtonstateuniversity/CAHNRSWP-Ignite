jQuery('body').on('change','.ignite-slide-categories-value', function(){
	var wrap = jQuery( this ).closest('.ignite-customizer-dropdown');
	var values = [];
	wrap.find('.ignite-slide-categories-value:checked').each(function(){
		values.push( jQuery( this ).val() );
	});
	wrap.find('.ignite-slide-categories').val( values.join() );
} );