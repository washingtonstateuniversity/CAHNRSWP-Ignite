<div class="ignite-post-editor">
	<div  class="ignite-field-set">
		<h2>BA & BS Degrees</h2>
		<div class="ignite-field">
			<label>Select Degree Type</label>
			<select name="_ignite_degree_type">
				<?php foreach( $degree_types as $value => $label ):?>
				<option value="<?php echo $value;?>" <?php selected( $value, $settings['_ignite_degree_type'] );?>><?php echo $label;?></option>
				<?php endforeach;?>
			</select>
			<div class="ignite-helper-text">Selecting a Degree Type and Saving Will Display Type Specific Form Fields.</div>
		</div>
		<h2>Intro Text</h2>
		<div class="ignite-field ignite-field-full">
			<?php  wp_editor( $post->post_content, 'content' );?>
		</div>
		<h2>What You'll Learn</h2>
		<div class="ignite-field">
			<label>Override Title</label>
			<input type="text" name="_learn_title" value="<?php echo $settings['_learn_title'];?>" />
		</div>
		<div class="ignite-field ignite-field-full">
			<?php  wp_editor( $settings['_learn'], '_learn' );?>
		</div>
		<h2>Careers</h2>
		<div class="ignite-field">
			<label>Override Title</label>
			<input type="text" name="_career_title" value="<?php echo $settings['_career_title'];?>" />
		</div>
		<div class="ignite-field ignite-field-full">
			<?php  wp_editor( $settings['_career'], '_career' );?>
		</div>
	</div>
</div>