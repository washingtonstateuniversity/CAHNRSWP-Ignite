<div class="ignite-slideshow-nav">
	<div class="ignite-slideshow-nav-button prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
	<div class="ignite-slideshow-nav-slides-wrapper">
		<?php foreach( $slides as $index => $slide ):?><div class="ignite-slideshow-nav-slide<?php if ( $slide->get_index() === 0 ) echo ' active';?>"></div><?php endforeach;?>
	</div>
	<div class="ignite-slideshow-nav-button next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
</div>