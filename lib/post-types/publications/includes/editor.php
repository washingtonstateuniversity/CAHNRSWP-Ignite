<div class="ignite-post-editor">
	<div  class="ignite-field-set">
		<h2>Publication Options</h2>
		<div class="ignite-field">
			<label>Link</label>
			<input type="text" name="_pub_link" value="<?php echo $publication['link'];?>" />
		</div>
		<div class="ignite-field">
			<label>Journal</label>
			<input type="text" name="_pub_journal" value="<?php echo $publication['journal'];?>" />
		</div>
		<div class="ignite-field">
			<label>Volume/Issue</label>
			<input type="text" name="_pub_volume" value="<?php echo $publication['volume'];?>" />
		</div>
		<div class="ignite-field">
			<label>Year</label>
			<input type="text" name="_pub_year" value="<?php echo $publication['year'];?>" />
		</div>
		<div class="ignite-field">
			<label>Authors</label>
			<input type="text" name="_pub_authors" value="<?php echo $publication['authors'];?>" />
		</div>
		<div class="ignite-field ignite-field-full">
			<label>Publication Summary</label>
			<textarea type="text" name="excerpt"><?php echo $post->post_excerpt;?></textarea>
		</div>
	</div>
</div>