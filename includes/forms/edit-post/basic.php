<?php
$show_title = get_post_meta( $post_id, '_show_title_single_ignite', true );
?>
<div class="post-editor-section-ignite">
	<div class="ignite-field select-field">
    	<label>Show Title</label>
    	<select name="_show_title_single_ignite">
        	<option value="" <?php selected( '', $show_title )?>>Default</option>
            <option value="show" <?php selected( 'show', $show_title )?>>Show</option>
            <option value="hide" <?php selected( 'hide', $show_title )?>>Hidden</option>
            <option value="remove" <?php selected( 'remove', $show_title )?>>Remove</option>
        </select>
    </div><div class="ignite-field select-field">
    	<label>Remove Page Banner</label>
		<input style="display:none" type="checkbox" name="_remove_page_banner" value="0" checked="checked" />
    	<input type="checkbox" name="_remove_page_banner" value="1" <?php checked( 1, $settings['_remove_page_banner'] );?> />
    </div>
</div>