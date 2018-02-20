<script>	
	
		var cahnrs_video_player = function(){
			
			this.video_wrapper = jQuery( '#cahnrs-play-video-banner' );
			
			var self = this;
			
			this.init = function(){
				
				self.video_wrapper.on( 
					'click',
					'.video-spacer a',
					function( event ){
						event.preventDefault();
						self.show_video();
					}
				);
				
			} // End init
			
			this.show_video = function(){
				
				var vid_id = self.get_video_id();
				
				var embed_code = self.get_embed_code( vid_id );
				
				var overlay = self.video_wrapper.find('.video-overlay');
				
				overlay.fadeIn('fast', function(){
					
					self.video_wrapper.addClass('active-video');
				
					self.video_wrapper.find('.video-spacer').prepend( embed_code );
					
				});
				
			}
			
			this.get_video_id = function(){
				
				vid_id = self.video_wrapper.data('video');
				
				return vid_id;
				
			}
			
			this.get_embed_code = function( vid_id ){
				
				var code = '<iframe src="https://www.youtube.com/embed/' + vid_id + '?rel=0&autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
				
				return code;
				
			}
			
			this.init();
			
		}
		var c_video_player = new cahnrs_video_player();
	
</script>