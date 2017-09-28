<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'part_id' ) ); ?>"><?php esc_attr_e( 'Part ID:' ); ?></label> 
	<input id="<?php echo esc_attr( $this->get_field_id( 'part_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'part_id' ) ); ?>" type="text" value="<?php echo esc_attr( $part_id ); ?>">
</p>