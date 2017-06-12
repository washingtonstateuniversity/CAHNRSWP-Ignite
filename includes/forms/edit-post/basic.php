<?php
$show_title = get_post_meta( $post_id, '_show_post_title_ignite', true );
?>
<div class="post-editor-section-ignite">
	<div class="ignite-field select-field">
    	<select name="_show_post_title_ignite">
        	<option value="" <?php selected( '', $show_title )?>>Default</option>
            <option value="show" <?php selected( 'show', $show_title )?>>Show</option>
            <option value="hide" <?php selected( 'hide', $show_title )?>>Hidden</option>
            <option value="remove" <?php selected( 'remove', $show_title )?>>Remove</option>
        </select>
    </div>
</div>