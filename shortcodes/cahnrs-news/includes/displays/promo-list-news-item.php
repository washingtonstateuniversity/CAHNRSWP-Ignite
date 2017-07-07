<div class="news-item promo-list-item<?php if ( ! empty( $news_item['image'] ) ) echo ' has-image';?>"><?php if ( ! empty( $news_item['image'] ) ):?>
		<div class="image-wrapper"><?php echo $news_item['link_start']; ?><img src="<?php echo CAHNRSIGNITEURL . 'images/image-square.gif';?>" style="background-image:url(<?php echo $news_item['image']; ?>);" /><?php echo $news_item['link_end']; ?>
		</div>
	<?php endif;?>
	<div class="caption">
		<h2><?php echo $news_item['link_start']; ?><?php echo $news_item['title']; ?><?php echo $news_item['link_end']; ?></h2>
		<div class="excerpt"><?php echo wp_trim_words( $news_item['excerpt'], $atts['excerpt_length'] ); ?></div>
	</div>
</div>