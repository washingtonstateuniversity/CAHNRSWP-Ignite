<?php $keyword = ( ! empty( $_GET['s'] )) ? sanitize_text_field( $_GET['s'] ) : ''; ?>
<div class="cahnrs-ignite-search-form <?php echo $class;?>-search-form">
	<form id="ignite-search-form">
		<div class="ignite-search-form-field ignite-search-form-field-keyword">
			<label for="ignite-search-form-keyword">Keyword</label> 
			<input id="ignite-search-form-keyword" type="text" value="<?php echo $keyword;?>" name="s" placeholder="Search" />
		</div>
		<div class="ignite-search-form-field ignite-search-form-field-submit">
			<input type="submit" id="ignite-search-form-submit" value="Submit" name="submit" />
		</div>
	</form>
</div>