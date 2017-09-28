if ( typeof ci_slideshow === 'undefined' ) {
	
	var ci_slideshow = function( slideshow ){
		
		this.show = slideshow;
		
		var self = this;
		
		this.init = function(){
			
			self.bind_events();
			
		} // End init
		
		this.bind_events = function(){
			
			self.show.on( 'click', '.ci-slide-controls div', function(){ self.do_slide_nav( jQuery( this ) ) });
			
			self.show.on( 'click', '.ci-slide-thumb', function(){ self.do_slide_thumb( jQuery( this ) ) });
			
		} // End bind_events
		
		this.do_slide_thumb = function( item_clicked ) {
			
			if ( self.show.hasClass('active-slide') ) return;
			
			var active_slide = self.get_active_side();
			
			var next_index = item_clicked.index();
			
			if ( active_slide.index() == next_index ) return;
			
			var next_slide = self.show.find('.ci-slide').eq( next_index );
			
			var dir = ( active_slide.index() > next_index )? -1:1;
			
			if ( next_slide.length ){
					
				self.do_slide( active_slide, next_slide, dir );
				
			} // end if
			
		} // End do_slide_thumb
		
		this.do_slide_nav = function( item_clicked ){
			
			if ( self.show.hasClass('active-slide') ) return;
			
			dir = ( item_clicked.hasClass('ci-prev-slide') ) ? -1:1;
			
			var active_slide = self.get_active_side();
			
			var next_index = self.get_next_slide_index( active_slide, dir );
			
			if ( next_index !== false ){
				
				var next_slide = self.show.find('.ci-slide').eq( next_index );
				
				if ( next_slide.length ){
					
					self.do_slide( active_slide, next_slide, dir );
					
				} // end if
				
			} // End if
			
		} // End do_slide_nav
		
		this.get_active_side = function(){
			
			var active = self.show.find('.ci-slide.active').first();
			
			if ( ! active.length ) {
				
				var active = self.show.find('.ci-slide').first();
				
				active.addClass('active');
				
			} // End if
			
			return active;
			
		} // End get_active_side
		
		this.get_next_slide_index = function( active_slide, dir ){
			
			var next_slide_index = false;
			
			var slides = self.show.find('.ci-slide');
			
			var count = slides.length;
			
			var active_slide_index = active_slide.index();
			
			if ( dir > 0 ){
				
				if ( active_slide_index < ( count - 1 ) ) {
					
					next_slide_index = ( active_slide_index + 1 );
					
				} else {
					
					next_slide_index = 0;
					
				} // End if
				
			} else {
				
				if ( active_slide_index === 0 ) {
					
					next_slide_index = ( count - 1 );
					
				} else {
					
					next_slide_index = ( active_slide_index - 1 );
					
				} // End if
				
			} // End if
			
			return next_slide_index;
			
		} // End get_next_slide
		
		this.do_slide = function( active_slide, next_slide, dir ) {
			
			self.show.addClass('active-slide');
			
			if ( dir > 0 ){
				
				var active_left = '-100%';
				var next_left = '100%';
				
			} else {
				
				var active_left = '100%';
				var next_left = '-100%';
			}
			
			next_slide.css( { left : next_left, top:0 });
			
			active_slide.animate({left: active_left}, 1000);
			next_slide.animate({left: 0}, 1000, function(){
				active_slide.removeClass('active');
				active_slide.removeAttr('style');
				next_slide.addClass('active');
				self.show.removeClass('active-slide');
				});
		} // End do_slide
		
		this.init();
		
	} // End ci_slideshow
	
} // End if

if ( typeof ci_slideshow_array === 'undefined' ) {
	
	var ci_slideshow_array = new Array();
	
} // End if

jQuery('.ci-slideshow.inactive').each(
	
	function(){
		
		var show = new ci_slideshow( jQuery( this ) ); 
		
		ci_slideshow_array.push( show );
		
	} // End function
	
) // End each