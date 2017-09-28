<div class="cahnrs-pagnination default-display <?php echo implode( ' ', $classes);?>">
	<div class="page-count">Showing page <?php echo $this->page;?> of <?php echo $this->pages;?></div>
	<div class="page-nav prev-nav">
		<a class="<?php if( $this->page <= 1 ) echo ' is-disabled';?>" href="<?php echo get_pagenum_link( $this->prev_page );?>"><i class="fa fa-caret-left" aria-hidden="true"></i></a>
	</div>
	<div class="pages">
		<?php for( $i = $start_index; $i <= $end_index; $i++ ):?><a href="<?php echo get_pagenum_link( $i );?>" class="<?php if( $i == $this->page ) echo ' is-current';?>"><?php echo $i;?></a><?php endfor;?>
	</div>
	<?php if ( $last_index ):?>
	<div class="page-filler">...</div>
	<div class="pages-end"><a href="<?php echo get_pagenum_link( $last_index );?>"><?php echo $last_index;?></a></div>
	<?php endif;?>
	<div class="page-nav prev-nav">
		<a class="<?php if( $this->page >= $this->pages ) echo ' is-disabled';?>" href="<?php echo get_pagenum_link( $this->next_page );?>"><i class="fa fa-caret-right" aria-hidden="true"></i></a>
	</div>
</div>