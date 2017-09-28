<div class="slide-edit-form">
	<h2>Slide Options</h2>
	<div class="ignite-field text-field">
		<label>Short Title (Optional)</label>
		<div class="description">Short title used in slideshows and other areas where text is limited.</div>
		<input type="text" name="_news_release_short_title" value="<?php echo $short_title;?>" />
	</div>
	<div class="ignite-field text-field">
		<label>Redirect URL (Optional)</label>
		<div class="description">Redirect to a story posted somewhere else.</div>
		<input type="text" name="_news_release_redirect_url" value="<?php echo $redirect_url;?>" />
	</div>
	<!--<div class="ignite-field image-field<?php if ( ! $slide_image_url ) echo ' no-image';?>">
		<label>Slide Image (Optional)</label>
		<div class="description">Alternate slide image. If not set the featured image will be used.</div>
		<div class="slide-image-wrapper" style="background-image:url(<?php echo $slide_image_url;?>)">
		<input type="text" name="_news_release_slide_image_url" value="<?php echo $slide_image_url;?>" />
		<button class="select-image">Select Image</button>
	</div> -->
</div>