<form class="cahnrs-search-shortcode <?php echo $atts['display'];?>-display" <?php if( $atts['results_url'] ):?>action="<?php echo $atts['results_url'];?>"<?php endif;?>>
	<div class="inner-wrapper">
		<?php foreach( $atts as $key => $value ):?>
			<div><?php if ( $value && ! in_array( $key, $exclude ) ):?><input type="hidden" name="ci-<?php echo $key;?>" value="<?php echo $value;?>" /><?php endif;?></div> 
		<?php endforeach;?>
		<div class="cahnrs-search-field ci-keyword-field">
			<input type="text" name="<?php echo $keyword_name;?>" value="" placeholder="Search"/>
		</div>
		<div class="cahnrs-search-field ci-submit-field">
			<button type="submit">Go</button>
		</div>
	</div>
</form>