<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'part_id' ) ); ?>"><?php esc_attr_e( 'Part ID:' ); ?></label>
	<select id="<?php echo esc_attr( $this->get_field_id( 'part_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'part_id' ) ); ?>">
		<?php foreach( $post_options as $tp_post_id => $tp_name ):?>
		<option value="<?php echo $tp_post_id;?>" <?php selected( $tp_post_id , $part_id );?>><?php echo $tp_name;?></option>
		<?php endforeach;?>
	</select> 
</p>