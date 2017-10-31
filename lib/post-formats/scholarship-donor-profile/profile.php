<div class="scholarship-donor-profile">
	<div class="profile-content">
		<?php if ( ! empty( $image ) ):?><img class="profile-image" src="<?php echo $image['src'];?>" /><?php endif;?>
		<?php echo $content;?>
		<div class="profile-footer">
			<?php if ( is_active_sidebar( 'scholarship-donor-profile-footer' ) ) {
				dynamic_sidebar( 'scholarship-donor-profile-footer' );
			} ?>
		</div>
	</div>
	<div class="profile-sidebar">
		<?php if ( is_active_sidebar( 'scholarship-donor-profile' ) ) {
			dynamic_sidebar( 'scholarship-donor-profile' );
		} ?>
	</div>
</div>