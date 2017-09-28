<div class="cahnrs-events-shortcode basic-display">
	<?php foreach( $events as $event ):?><div class="cahnrs-event">
		<div class="cahnrs-event-link"><a href="<?php echo esc_url( tribe_get_event_link( $event->ID ) ); ?>" rel="bookmark">View Event Details</a></div>
		<div class="cahnrs-event-calendar-details">
			<span class="cahnrs-day"><?php echo tribe_get_start_date( $event->ID, false, 'j' );?></span>
			<span class="cahnrs-month"><?php echo tribe_get_start_date( $event->ID, false, 'M' );?></span>
		</div>
		<div class="cahnrs-event-details"><h3><?php echo get_the_title( $event->ID );?></h3><?php if ( $atts['show_venue'] ):?><div class="cahnrs-event-venue"><?php echo tribe_get_venue( $event->ID );?></div><?php endif;?>
			<div class="cahnrs-event-button">Event Details</div>
		</div>
	</div><?php endforeach;?>
</div>