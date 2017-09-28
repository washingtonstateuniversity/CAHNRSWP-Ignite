<?php

// Copied from old News Release Plugin

$value = get_post_meta( $post->ID, '_sources', true );
		
//print_r($value);

echo '<div id="news-release-sources"><h2>News Sources: <span>(Optional)</span></h2><div class="sources-container">';

// Here comes the inelegant part...

echo '<div class="source">';
echo '<label for="name_1">Name, Title</label><br />';
echo '<input type="text" id="name_1" name="name_1" value="' . $value['name_1'] . '" class="widefat" /><br />';
echo '<label for="info_2">Phone, Email</label><br />';
echo '<input type="text" id="info_1" name="info_1" value="' . $value['info_1'] . '" class="widefat" /><br />';
echo '</div>';

if ( $value['name_2'] ) {
	echo '<div class="source">';
	echo '<label for="name_2">Name, Title</label><br />';
	echo '<input type="text" id="name_2" name="name_2" value="' . $value['name_2'] . '" class="widefat" /><br />';
	echo '<label for="info_2">Phone, Email</label><br />';
	echo '<input type="text" id="info_2" name="info_2" value="' . $value['info_2'] . '" class="widefat" /><br />';
	echo '</div>';
}

if ( $value['name_3'] ) {
	echo '<div class="source">';
	echo '<label for="name_3">Name, Title</label><br />';
	echo '<input type="text" id="name_3" name="name_3" value="' . $value['name_3'] . '" class="widefat" /><br />';
	echo '<label for="info_3">Phone, Email</label><br />';
	echo '<input type="text" id="info_3" name="info_3" value="' . $value['info_3'] . '" class="widefat" /><br />';
	echo '</div>';
}

if ( $value['name_4'] ) {
	echo '<div class="source">';
	echo '<label for="name_4">Name, Title</label><br />';
	echo '<input type="text" id="name_4" name="name_4" value="' . $value['name_4'] . '" class="widefat" /><br />';
	echo '<label for="info_4">Phone, Email</label><br />';
	echo '<input type="text" id="info_4" name="info_4" value="' . $value['info_4'] . '" class="widefat" /><br />';
	echo '</div>';
}

if ( $value['name_5'] ) {
	echo '<div class="source">';
	echo '<label for="name_5">Name, Title</label><br />';
	echo '<input type="text" id="name_5" name="name_5" value="' . $value['name_5'] . '" class="widefat" /><br />';
	echo '<label for="info_5">Phone, Email</label><br />';
	echo '<input type="text" id="info_5" name="info_5" value="' . $value['info_5'] . '" class="widefat" /><br />';
	echo '</div>';
}

echo '</div>';

echo '<p><a href="#" id="add-news-release-source">+ Add additional source</a></p></div>';?>
<script>
jQuery(document).ready(function($){

	var counter = $('.sources-container > .source').length;

	$('#news-release-sources').on('click', '#add-news-release-source', function(event) {

		event.preventDefault();

		counter++;

		// Yes, this is clunky (hey, I just make this stuff up as I go).
		// Top out at 5 sources until the PHP can be refined to be more dynamic.
		if ( counter < 6 ) {

			var row = $('.source:first').clone();
	
			$(row).find("input[type='text']").each(function(){
				$(this).attr( 'name', $(this).attr('name').replace( '1', counter ) );
				$(this).attr( 'id', $(this).attr('id').replace( '1', counter ) );
				$(this).val('');
			});
			row.appendTo('.sources-container');

		}

		console.log(counter);
		
	});

});
</script>