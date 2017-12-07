<div class="ignite-post-editor">
	<div  class="ignite-field-set">
		<h2>Degree Type</h2>
		<div class="ignite-field">
			<label>Select Degree Type</label>
			<select name="_ignite_degree_type">
				<?php foreach( $degree_types as $value => $label ):?>
				<option value="<?php echo $value;?>" <?php selected( $value, $settings['_ignite_degree_type'] );?>><?php echo $label;?></option>
				<?php endforeach;?>
			</select>
			<div class="ignite-helper-text">Selecting a Degree Type and Saving Will Display Type Specific Form Fields.</div>
		</div>
	</div>
</div>