<div class="ignite-post-editor">
	<div  class="ignite-field-set">
		<h2>Video Options</h2>
		<div class="ignite-field">
			<label>Video URL</label>
			<input type="text" name="_video_id" value="<?php echo $video['id'];?>" />
			<div class="ignite-helper-text">Video URL can be the full YouTube URL or the ID for the video. Example: https://www.youtube.com/watch?v=<b>4rb8aOzy9t4</b> or simply the ID <b>4rb8aOzy9t4</b>.</div>
		</div>
		<div class="ignite-field">
			<label>Video Image</label>
			<input type="text" name="_video_img_src" value="<?php echo $video['img_src'];?>" />
			<div class="ignite-helper-text">If the video image is left empty it will automatically be set to the default YouTube thumbnail. The "Featured Image" will override this setting.</div>
		</div>
		<div class="ignite-field ignite-field-full">
			<label>Video Summary</label>
			<textarea type="text" name="excerpt"><?php echo $post->post_excerpt;?></textarea>
			<div class="ignite-helper-text">Provide a plain text description of the video ( 1-4 sentances ). The summary will render on the video page above the "Video Page Content".</div>
		</div>
	</div>
</div>