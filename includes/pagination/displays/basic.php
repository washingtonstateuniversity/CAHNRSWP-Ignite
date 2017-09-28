<div class="cahnrs-pagnination basic-display"><form method="get">
	<div class="page-nav prev-nav"><button type="submit" class="<?php if( $this->page <= 1 ) echo ' is-disabled';?>" type="submit" name="ci-page" value="<?php echo $this->prev_page; ?>" <?php if( $this->page <= 1 ) echo ' disabled="disabled"';?>><i class="fa fa-caret-left" aria-hidden="true"></i>
</button></div>
	<div class="pages">
		<?php for( $i = $start_index; $i <= $end_index; $i++ ):?><input class="<?php if( $i == $this->page ) echo ' is-current';?>" type="submit" name="ci-page" value="<?php echo $i;?>" /><?php endfor;?>
	</div>
	<?php if ( $last_index ):?>
	<div class="page-filler">...</div>
	<div class="pages-end"><input type="submit" name="ci-page" value="<?php echo $last_index;?>" /></div>
	<?php endif;?>
	<div class="page-nav prev-nav"><button type="submit" class="<?php if( $this->page >= $this->pages ) echo ' is-disabled';?>" type="submit" name="ci-page" value="<?php echo $this->next_page;?>" <?php if( $this->page >= $this->pages ) echo ' disabled="disabled"';?>><i class="fa fa-caret-right" aria-hidden="true"></i>
</button></div><div class="page-count">Showing page <?php echo $this->page;?> of <?php echo $this->pages;?></div>
</form></div>