<div class="content-wrapper">
	<div class="ignite-video-banner <?php echo implode(' ', $video_classes );?>">
		<div class="ignite-video-container-wrapper">
		<div class="ignite-video-container" style="background-image:url(<?php echo $video_settings['bg-image'];?>)">
			<iframe src="https://player.vimeo.com/video/<?php echo $video_settings['video-id'];?>?autoplay=true&amp;loop=1&amp;background=1" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
		</div>
		</div>
		<div class="ignite-video-container-spacer">
			<div class="ignite-video-container-widget-area">
				<div class="ignite-video-container-widget-area-inner">
					<div class="ignite-video-container-widget">
						<?php if ( is_active_sidebar( 'video_banner' ) ) { dynamic_sidebar( 'video_banner' ); } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>