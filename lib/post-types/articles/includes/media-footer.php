<footer class="ignite-media-footer">
	<?php if ( ! empty( $sources[0]['name'] ) ):?><div class="ignite-sources">
		<h2>Media Contact</h2>
		<div class="ignite-media-contact-name"><?php echo $sources[0]['name'];?></div>
	<?php if ( ! empty( $sources[0]['email'] ) ):?><div class="ignite-media-contact-email"><a href="mailto:<?php echo $sources[0]['email'];?>"><?php echo $sources[0]['email'];?></a></div><?php endif;?>
		<?php if ( ! empty( $sources[0]['phone'] ) ):?><div class="ignite-media-contact-phone"><?php echo $sources[0]['phone'];?></div><?php endif;?>
	</div><?php endif;?>
</footer>