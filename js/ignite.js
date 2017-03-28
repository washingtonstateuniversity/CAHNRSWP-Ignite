var ignite = {
	
	init:function(){
		
		ignite.banners.events();
		
	},
	
	banners: {
		
		events:function(){
			
			jQuery( window ).scroll(
				function( e ){
					
					if ( jQuery('.parallax-banner' ).length > 0 ){
						
						jQuery('.parallax-banner' ).each( function(){
						
							ignite.banners.parallax_banner.do_scroll( jQuery( this ) );
						
						})
					
					} // end if
				} 
				
			) // end scroll event
			
		}, // end evetns
		
		parallax_banner:{
			
			do_scroll:function( banner ){
				
				var wh = jQuery( window ).scrollTop();
				
				var top = ( ( ( wh / 600 ) * 30 ) - 30 );
				
				banner.find('.banner-image').css( 'top', top + '%' ); 
				
				console.log( top );
				
				//var b_scroll = ignite.banners.parallax_banner.get_banner_scroll( banner );
				
				//console.log( offset );
				
			}, // end do_scroll
			
			get_banner_scroll:function( banner ){
				
				b_height = banner.height();
				s_top = banner.scrollTop();
				
				var s = {
					top: s_top,
					bottom: s_top + b_height,
				};
				
				return s;
			
			}, // end get_banner_scroll_bottom
			
		}, // end parallax_banner
		
	}, // end banners
	
} // end ignite

ignite.init();