<div class="news-item promo-list-item<?php if ( ! empty( $post->post_images ) ) echo ' has-image';?>"><?php if ( ! empty( $post->post_images ) ):?>
		<div class="image-wrapper">
			<img src="<?php echo CAHNRSIGNITEURL . 'images/image-square.gif';?>" style="background-image:url(<?php echo $post->post_images['medium']; ?>);" alt="<?php echo htmlspecialchars ( strip_tags ( $post->post_title ) ); ?>" />
		</div>
	<?php endif;?>
	<div class="caption">
		<h3><?php echo $post->post_title; ?></h3>
		<?php if( $atts['show_date'] ):?><div class="meta">Published on <time><?php echo date("F jS, Y", strtotime( $post->post_date ) );?></time></div><?php endif;?>
		<div class="excerpt"><?php echo wp_trim_words( $post->post_excerpt, $atts['excerpt_length'] ); ?></div>
		<?php if( $atts['show_read_more'] ):?><div class="more-button">Read More</div><?php endif;?>
	</div>
	<?php if ( ! empty( $post->post_content ) || ! empty( $has_redirect )  ):?><div class="link"><?php echo $post->get_link_html(); ?><?php echo $post->post_title; ?><?php echo $post->get_link_html( true ); ?></div><?php endif; ?>
</div>