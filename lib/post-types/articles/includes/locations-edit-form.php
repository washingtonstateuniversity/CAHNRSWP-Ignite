<div class="locations-edit-form">
	<div class="distribute-type horz-inputs set-wrapper">
		<h2>Distribute:</h2>
		<div class="ignite-field checkbox-field">
			<input id="college-wide_distribute" type="checkbox" name="_article_distribute[]" value="college-wide" <?php if ( in_array( 'college-wide', $distribute ) ) echo 'checked="checked"';?> />
			<label for="college-wide_distribute">College Wide</label>
		</div>
	</div>
	<div class="content-type horz-inputs set-wrapper">
		<h2>Placement:</h2>
		<div class="ignite-field checkbox-field">
			<input id="feature-slideshow_placement_input" type="checkbox" name="_article_placement[]" value="feature-slideshow" <?php if ( in_array( 'feature-slideshow', $placement ) ) echo 'checked="checked"';?> />
			<label for="feature-slideshow_placement_input">Feature Slideshow</label>
		</div>
		<!--<div class="ignite-field checkbox-field">
			<input id="spotlight_placement_input" type="checkbox" name="_article_placement[]" value="spotlight" <?php if ( in_array( 'spotlight', $placement ) ) echo 'checked="checked"';?> />
			<label for="spotlight_placement_input">Spotlight</label>
		</div> -->
		<div class="ignite-field checkbox-field">
			<input id="news-feed_placement_input" type="checkbox" name="_article_placement[]" value="news-feed" <?php if ( in_array( 'news-feed', $placement ) ) echo 'checked="checked"';?> />
			<label for="news-feed_placement_input">News Feed</label>
		</div>
		<div class="ignite-field checkbox-field">
			<input id="no-feed_placement_input" type="checkbox" name="_article_placement[]" value="no-positon" <?php if ( in_array( 'no-positon', $placement ) ) echo 'checked="checked"';?> />
			<label for="no-feed_placement_input">No Feed</label>
		</div>
	</div>
</div>