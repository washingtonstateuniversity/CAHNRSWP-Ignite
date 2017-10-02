var cahnrs_ignite = function(){
	
	this.slideshows = [];
	
	var self = this;
	
	this.init = function(){
	}; // End init
	
	this.spotlight_slideshow = function( wrapper ) {
	} // End spotlight_slideshow
	
	this.init();
	
} // End cahnrs_ignite

var ignite_slideshow = function( wrapper ){
	this.action = 'slide';
	this.is_auto = false;
	this.speed = 1000;
	this.show_for = 6000;
	this.wrapper = wrapper;
	this.timer = false;
	var self = this;
	
	this.init = function(){
		
		self.set_properties();
		
		self.nav_events();
		
		self.set_timer();
		
	} // End init
	
	this.set_properties = function(){
		
		if ( self.wrapper.attr('data-speed') ) {
			
			self.speed = self.wrapper.attr('data-speed');
			
		} // End if
		
		if ( self.wrapper.attr('data-isauto') ) {
			
			if ( self.wrapper.find('.ignite-slide').length > 1 ){
			
				self.is_auto = true;
				
			} else {
				
				self.is_auto = false;
				
			} // End if
			
		} // End if
		
		if ( self.wrapper.attr('data-action') ) {
			
			self.action = self.wrapper.attr('data-action');
			
		} // End if
		
	} // End this.set_properties
	
	this.nav_events = function(){
		
		self.wrapper.on(
			'click', 
			'.ignite-slideshow-nav-button', 
			function(){ 
				self.do_nav_change( jQuery( this ) ); 
			} 
		);
		
		self.wrapper.on(
			'click', 
			'.ignite-slideshow-nav-slide:not(.active)', 
			function(){ 
				self.do_manual_change( jQuery( this ) ); 
			} 
		);
		
	} // end nav_events
	
	this.do_nav_change = function( ic ){
		
		var dir = ( ic.hasClass('next') )? 1 : -1;
		
		var current_slide = self.get_current_slide();
		
		var next_slide = self.get_next_slide( current_slide, false, dir );
		
		self.change_slide( current_slide, next_slide, dir );
		
	} // End do_nav_change
	
	this.do_manual_change = function( ic ){
		
		var current_slide = self.get_current_slide();
		
		var dir = ( current_slide.index() < ic.index() )? 1 : -1;
		
		var next_slide = self.get_next_slide( current_slide, ic.index(), dir );
		
		self.change_slide( current_slide, next_slide, dir );
		
	} // End do_nav_change
	
	this.do_auto_change = function(){
		
		var dir = 1;
		
		var current_slide = self.get_current_slide();
		
		var next_slide = self.get_next_slide( current_slide, false, dir );
		
		self.change_slide( current_slide, next_slide, dir );
		
	} // End do_nav_change
	
	this.change_slide = function (current_slide, next_slide, dir ){
		
		if ( self.wrapper.hasClass('is-animated')) return;
		
		self.do_before_slide( current_slide, next_slide, dir );
		
		switch( self.action ){
				
			case 'slide':
			default:
				self.change_slide_slide( current_slide, next_slide, dir );
				break;
				
		} // End switch
		
	} // End change_slide
	
	this.change_slide_slide = function ( current_slide, next_slide, dir ){
		
		c_slide_left = ( dir > 0 )? '-100%':'100%';
		
		n_slide_left = ( dir > 0 )? '100%':'-100%';
		
		next_slide.css( { 'top': 0, 'left': n_slide_left } );
		
		current_slide.animate( {'left':c_slide_left}, self.speed, function(){
			
			self.do_after_slide( current_slide, next_slide, dir );
		
			} 
		);
		
		next_slide.animate( {'left':0}, self.speed );
		
	} // End change_slide_slide
	
	this.do_before_slide = function( current_slide, next_slide, dir ){
		
		self.wrapper.addClass('is-animated');
		
		self.change_nav_slide( next_slide );
		
	} // End do_before_slide
	
	this.do_after_slide = function( current_slide, next_slide, dir ){
		
		self.wrapper.removeClass('is-animated');
		
		self.set_active_slide( next_slide );
			
		self.set_timer();
		
	} // End after_slide
	
	this.change_nav_slide = function( next_slide ){
		
		var index = next_slide.index();
		
		self.wrapper.find('.ignite-slideshow-nav-slide.active').removeClass('active');
		
		self.wrapper.find('.ignite-slideshow-nav-slide').eq( index ).addClass('active');
		
	} // End change_nav_slide
	
	this.get_current_slide = function (){
		
		var slide = self.wrapper.find('.ignite-slide.active').first();
		
		if ( slide.length < 1 ){
			
			var slide = self.wrapper.find('.ignite-slide').first();
			
		} // End if
		
		return slide;
		
	} // End get_current_slide
	
	this.get_next_slide = function ( current_slide, next_index, dir ){
		
		if ( next_index ){
			
			var slide = self.wrapper.find('.ignite-slide').eq( next_index );
			
		} else {
			
			var slides = self.wrapper.find('.ignite-slide');
			
			var n_index = ( current_slide.index() + dir );
			
			var last_index = self.wrapper.find('.ignite-slide').last().index();
			
			if ( n_index < 0 ){
				
				var slide = self.wrapper.find('.ignite-slide').last();
				
			} else if ( n_index > last_index ){
				
				var slide = self.wrapper.find('.ignite-slide').first();
				
			} else {
				
				var slide = self.wrapper.find('.ignite-slide').eq( n_index );
				
			}// End if
			
		} // End if
		
		return slide;
		
	} // End get_next_slide
	
	this.set_active_slide = function( slide ){
		
		self.wrapper.find('.ignite-slide.active').removeClass('active');
		
		slide.addClass('active');
		
	} // End set_active_slide
	
	
	this.set_timer = function(){
		
		clearTimeout( self.timer );
		
		if ( self.is_auto ){
			
			self.timer = setTimeout(function(){ self.do_auto_change(); }, self.show_for );
			
		} // End if
		
	}; // End set_timer
	
	this.init();
	
} // End ignite_slideshow

jQuery('body').find('.ignite-slideshow').each( 
	function( index ){
		window[ index + '-slideshow'] = new ignite_slideshow( jQuery( this ) );
	} // End each
);

var instance_cahnrs_ignite = new cahnrs_ignite();



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
			
			timer:false,
			
			bind_events:function(){
				
				jQuery( 'body' ).on(
					'click',
					'.college-name-logo',
					function( event ){
						
						if ( ignite.check_mobile() ){
							
							event.preventDefault();
							
							jQuery('#college-global-navigation').slideToggle('fast');
							
						} // end if
						
					}
				);

				/*jQuery('body').on( 
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
				*/
				
				jQuery('#college-global-navigation .top-menu-item').hover(
					function(){ 
						var menu = jQuery( this ).find('.drop-down-menu');
						if ( ! ignite.check_mobile() ) {
							ignite.headers.college_global.timer = setTimeout(function(){ 
								menu.slideDown('fast') ; }, 
								200
							);
						} // End if
					},
					function(){
						clearTimeout( ignite.headers.college_global.timer );
						var menu = jQuery( this ).find('.drop-down-menu');
						menu.stop();
						menu.slideUp('fast');
					}
				);
				
			}, // End init
			
			show_drop:function( parent, menu ){
				menu.stop();
				menu.delay(1000).slideDown('fast') 
			} // show_drop
			
		} // End college_global
		
	}, // End headers
	
	check_mobile:function(){
		
		var spine_header = jQuery( '#spine .spine-header');
						
		if ( 'fixed' == spine_header.css('position') ){
			
			return true;
			
		} // end if
		
		return false;
		
	}, // End check_mobile
	
	slideshow:{
		
		init:function(){
		}, // End init
		
		
		
	}, // End slideshow
	
} // end ignite

ignite.init();