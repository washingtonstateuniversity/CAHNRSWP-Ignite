var ignite = {
	
	init:function(){
		
		ignite.banners.bind_events();
		ignite.headers.bind_events();
		
	},
	
	banners: {
		
		bind_events:function(){
			
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
	
	headers:{
		
		bind_events:function(){
			
			ignite.headers.college_global.bind_events();
			
		}, // End init
		
		college_global:{
			
			bind_events:function(){

				jQuery('body').on( 
					'click', 
					'#college-global-nav > ul > li > a', 
					function( event ){
						
						var p = jQuery( this ).closest('li');
						
						if ( p.hasClass('active') ){
							
							p.removeClass('active' );
							
						} else {
							
							p.addClass('active' );
							
						}// End if
						
						if ( 'absolute' === jQuery('#college-global-navigation .college-global').css('position') ){
							event.preventDefault();
							jQuery('#college-global-navigation .college-global').slideToggle();
							
						} // end if
						
					} 
				); // End on click
				
			} // End init
			
		} // End college_global
		
	} // End headers
	
} // end ignite

ignite.init();