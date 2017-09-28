<div class="cahnrs-news-shortcode shortcode-wrapper <?php echo $atts['display']; ?>">
	<?php if ( $atts['show_pagination_before'] ) echo $pagination_html;?>
	<?php echo $inner_html; ?>
	<?php if ( $atts['show_pagination'] && ! $atts['hide_pagination_after'] ) echo $pagination_html;?>
</div>