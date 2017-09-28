<div class="cahnrs-publication-item">
	<div class="caption">
		<?php if ( ! empty( $publication['journal']['name'] ) ) :?><div class="caption-journal-title"><h3><span>Published In</span> <?php echo $publication['journal']['name'];?></h3></div><?php endif;?>
		<?php if ( ! empty( $publication['title'] ) ) :?><div class="caption-article-title"><h4><?php if ( ! empty( $publication['link'] ) ) :?><a href="<?php echo $publication['link'];?>"><?php endif;?><?php echo $publication['title'];?><?php if ( ! empty( $publication['link'] ) ) :?></a><?php endif;?></h4></div><?php endif;?>
		<div class="caption-authors">Authors: <span><?php echo $author_html; ?></span></div>
	</div>
</div>