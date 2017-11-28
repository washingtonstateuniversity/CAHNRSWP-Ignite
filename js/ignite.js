/*
* Video banner object used for ignite front page
*/
var ignite_video_banner = function( banner ){

	this.banner = banner;
	this.ratio = 0.5625;
	this.video_wrapper = this.banner.find( '.ignite-video-container-wrapper');
	this.video = this.banner.find( '.ignite-video-container');
	this.video_iframe = this.video.find('iframe');
	this.video_spacer = this.banner.find('.ignite-video-container-spacer');
	this.video_widget_area = this.banner.find('.ignite-video-container-widget-area');
	this.player = false;
	var self = this;

	this.events = function(){

		jQuery( window ).resize(
			function(){
				self.resize();
			}
		);

	} // End events

	this.resize = function(){
		
		self.video.css( 'padding-bottom','0');
		
		if ( self.banner.hasClass('height-full') ) {
			
			self.set_full_video_height();
			
		} // end if
		
		this.check_spacer_height();
		
		var video_w = self.video_wrapper.width();
		var video_h = self.video_wrapper.height();

		var ratio = ( video_h / video_w );

		if ( ratio > self.ratio ){

			self.set_video_height( video_h, video_w );

		} else {

			self.set_video_width( video_h, video_w );

		} // End if

	}; // End resize
	
	this.check_spacer_height = function(){
		
		//this.video_spacer.css('height', null);
		//this.video_widget_area.css('height', null);
		
		var spacer_h = this.video_spacer.height();
		var widget_h = this.video_widget_area.outerHeight();
		
		if ( widget_h > spacer_h ){
			
			this.set_video_wrapper_height( widget_h );
			
		} else {
			
			this.video_widget_area.height( spacer_h );
			
		}// End if
		
	} // End check_spacer_height

	this.set_video_height = function( window_h, window_w ){
		
		console.log( window_h );

		self.video.height( window_h );

		var video_w = ( window_h / self.ratio );

		var margin = ( ( video_w - window_w ) * 0.5 );

		self.video.css( 'left','-' + margin + 'px' );

		self.video.width( video_w );

		//console.log('set window height');

	}; // End get_video_height
	
	
	this.set_full_video_height = function(){
		
		var window_w = jQuery( window ).width();
		
		var window_h = jQuery( window ).height();
		
		var offset = self.banner.offset().top;
		
		var wrapper_h = ( window_h - offset );
		
		this.set_video_wrapper_height( wrapper_h );
		
	}; // End set_full_video_height
	
	
	this.set_video_wrapper_height = function( wrapper_h ){
		
		//alert( wrapper_h );
		
		self.video_wrapper.height( wrapper_h );
		
		self.video_spacer.height( wrapper_h );
		
	}; // End set_video_wrapper_height
	

	this.set_video_width = function( window_h, window_w ){

		self.video.css( {'width':'100%','left':0 } );

		var video_h = ( window_w * self.ratio );

		var margin = ( ( video_h - window_h ) * 0.5 );

		self.video.css( 'top','-' + margin + 'px' );

		self.video.height( video_h );

		//console.log('set window width');

	} // End get_video_height

	this.do_video = function(){

		var iframe = self.video_iframe;

		self.player = new Vimeo.Player( iframe );
		
		setTimeout( function(){ self.video_iframe.fadeIn('fast'); }, 1000 );

	} // End do_video

	this.events();

	this.do_video();

	this.resize();

} // End video_banner


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
		
	}; // End init
	
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
		
		if ( self.wrapper.attr('data-delay') ) {
			
			self.show_for = self.wrapper.attr('data-delay');
			
		} // End if
		
	}; // End this.set_properties
	
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
		
	}; // end nav_events
	
	this.do_nav_change = function( ic ){
		
		var dir = ( ic.hasClass('next') )? 1 : -1;
		
		var current_slide = self.get_current_slide();
		
		var next_slide = self.get_next_slide( current_slide, false, dir );
		
		self.change_slide( current_slide, next_slide, dir );
		
	}; // End do_nav_change
	
	this.do_manual_change = function( ic ){
		
		var current_slide = self.get_current_slide();
		
		var dir = ( current_slide.index() < ic.index() )? 1 : -1;
		
		var next_slide = self.get_next_slide( current_slide, ic.index(), dir );
		
		self.change_slide( current_slide, next_slide, dir );
		
	}; // End do_nav_change
	
	this.do_auto_change = function(){
		
		var dir = 1;
		
		var current_slide = self.get_current_slide();
		
		var next_slide = self.get_next_slide( current_slide, false, dir );
		
		self.change_slide( current_slide, next_slide, dir );
		
	}; // End do_nav_change
	
	this.change_slide = function (current_slide, next_slide, dir ){
		
		if ( self.wrapper.hasClass('is-animated')) return;
		
		self.do_before_slide( current_slide, next_slide, dir );
		
		switch( self.action ){
				
			case 'slide':
			default:
				self.change_slide_slide( current_slide, next_slide, dir );
				break;
				
		} // End switch
		
	}; // End change_slide
	
	this.change_slide_slide = function ( current_slide, next_slide, dir ){
		
		var c_slide_left = ( dir > 0 )? '-100%':'100%';
		
		var n_slide_left = ( dir > 0 )? '100%':'-100%';
		
		next_slide.css( { 'top': 0, 'left': n_slide_left } );
		
		current_slide.animate( {'left':c_slide_left}, self.speed, function(){
			
			self.do_after_slide( current_slide, next_slide, dir );
		
			} 
		);
		
		next_slide.animate( {'left':0}, self.speed );
		
	}; // End change_slide_slide
	
	this.do_before_slide = function( current_slide, next_slide, dir ){
		
		self.wrapper.addClass('is-animated');
		
		self.change_nav_slide( next_slide );
		
	}; // End do_before_slide
	
	this.do_after_slide = function( current_slide, next_slide, dir ){
		
		self.wrapper.removeClass('is-animated');
		
		self.set_active_slide( next_slide );
			
		self.set_timer();
		
	}; // End after_slide
	
	this.change_nav_slide = function( next_slide ){
		
		var index = next_slide.index();
		
		self.wrapper.find('.ignite-slideshow-nav-slide.active').removeClass('active');
		
		self.wrapper.find('.ignite-slideshow-nav-slide').eq( index ).addClass('active');
		
	}; // End change_nav_slide
	
	this.get_current_slide = function (){
		
		var slide = self.wrapper.find('.ignite-slide.active').first();
		
		if ( slide.length < 1 ){
			
			var slide = self.wrapper.find('.ignite-slide').first();
			
		} // End if
		
		return slide;
		
	}; // End get_current_slide
	
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
		
	}; // End get_next_slide
	
	this.set_active_slide = function( slide ){
		
		self.wrapper.find('.ignite-slide.active').removeClass('active');
		
		slide.addClass('active');
		
	}; // End set_active_slide
	
	
	this.set_timer = function(){
		
		clearTimeout( self.timer );
		
		if ( self.is_auto ){
			
			self.timer = setTimeout(function(){ self.do_auto_change(); }, self.show_for );
			
		} // End if
		
	}; // End set_timer
	
	this.init();
	
}; // End ignite_slideshow

jQuery('body').find('.ignite-slideshow').each( 
	function( index ){
		window[ index + '-slideshow'] = new ignite_slideshow( jQuery( this ) );
	} // End each
);

var instance_cahnrs_ignite = new cahnrs_ignite();



var ignite = {
	
	init:function(){
		ignite.banners.init_banners();
		ignite.banners.bind_events();
		ignite.headers.bind_events();
		ignite.accordions.bind_events();
		
	},
	
	accordions: {
		
		bind_events:function(){
			
			jQuery( 'body' ).on(
					'click',
					'.ignite-content-accordion-title',
					function( event ){
						
						if ( jQuery(this).hasClass('active') ){
							
							jQuery(this).removeClass('active');
						
							jQuery(this).siblings('.ignite-content-accordion-content').slideUp('fast');
							
						} else {
							
							jQuery(this).addClass('active');
						
							jQuery(this).siblings('.ignite-content-accordion-content').slideDown('fast');
							
						} // End if
						
					}
				);
			
			jQuery( 'body' ).on(
					'click',
					'.ignite-accordion-title',
					function( event ){
						
						if ( jQuery(this).hasClass('active') ){
							
							jQuery(this).removeClass('active');
						
							jQuery(this).siblings('.ignite-accordion-content').slideUp('fast');
							
						} else {
							
							jQuery(this).addClass('active');
						
							jQuery(this).siblings('.ignite-accordion-content').slideDown('fast');
							
						} // End if
						
						var par = jQuery(this).closest('.ignite-accordion');
						
						par.siblings().find('.ignite-accordion-title').removeClass('active');
						
						par.siblings().find('.ignite-accordion-content').slideUp('fast');
						
					}
				);
			
		}, // end evetns
		
	},
	
	banners: {
		
		init_banners: function(){
			
			jQuery('.ignite-video-banner').each( 
				
				function( index, value ){ 
					
				window['ignite_video' + index] = new ignite_video_banner( jQuery(this) ); 
					
			});
			
		}, // End init_banners
		
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
		
		video_banner: {
			
		}, // End video banner 
		
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