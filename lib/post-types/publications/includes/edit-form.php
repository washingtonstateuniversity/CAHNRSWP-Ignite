<style>
</style>
<div id="theme-part-editor">
	<div class="theme-part-field">
		<label>Publication Link</label>
		<input type="text" name="_redirect_url" value="<?php echo get_post_meta( $post->ID, '_redirect_url', true );?>" />
	</div>
	<div class="theme-part-field-set">
		<?php foreach( $authors as $index => $author ):?>
		<div class="theme-part-field">
			<label>Author Name</label>
			<input type="text" name="_authors[<?php echo $index;?>][name]" value="<?php echo $author['name'];?>" placeholder="Name" />
		</div>
		<div class="theme-part-field">
			<label>Author Email</label>
			<input type="text" name="_authors[<?php echo $index;?>][email]" value="<?php echo $author['email'];?>" placeholder="Email" />
		</div>
		<div class="theme-part-field">
			<label>Author Department</label>
			<input type="text" name="_authors[<?php echo $index;?>][dept]" value="<?php echo $author['dept'];?>" placeholder="Department" />
		</div>
		<?php endforeach;?>
	</div>
</div>