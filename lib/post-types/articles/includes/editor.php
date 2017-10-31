<div class="ignite-post-editor">
	<div  class="ignite-field-set">
		<h2>Media Contact</h2>
		<div class="ignite-field">
			<label>Name & Title</label>
			<input type="text" name="_sources[0][name]" value="<?php if( ! empty( $sources[0]['name'] ) ) echo $sources[0]['name'];?>" />
		</div>
		<div class="ignite-field">
			<label>Email</label>
			<input type="text" name="_sources[0][email]" value="<?php if( ! empty( $sources[0]['email'] ) ) echo $sources[0]['email'];?>" />
		</div>
		<div class="ignite-field">
			<label>Phone</label>
			<input type="text" name="_sources[0][phone]" value="<?php if( ! empty( $sources[0]['phone'] ) ) echo $sources[0]['phone'];?>" />
		</div><?php if ( ! empty( $sources[0]['info'])):?><div class="ignite-field">
			<label>Info (old)</label>
			<input type="text" name="_sources[0][info]" value="<?php echo $sources[0]['info'];?>" />
		</div><?php endif;?>
	</div>
	<div  class="ignite-field-set">
		<h2>Story Placement: <span>(Required)</span></h2>
		<div class="news-placement">
			<div class="ignite-field checkbox-field">
				<input id="college-wide_distribute" type="checkbox" name="_article_distribute" value="college-wide" <?php checked( 'college-wide', $distribute )?> />
				<label for="college-wide_distribute">College Wide</label>
			</div>
			<div class="ignite-field checkbox-field">
				<input id="local_distribute" type="checkbox" name="_article_distribute" value="local" <?php checked( 'local', $distribute )?> />
				<label for="local_distribute">Local Only</label>
			</div>
			<div class="ignite-field checkbox-field">
				<input id="hidden_distribute" type="checkbox" name="_article_distribute" value="hidden" <?php checked( 'hidden', $distribute )?> />
				<label for="hidden_distribute">Hidden (by link only)</label>
			</div>
		</div>
	</div>
	<div  class="ignite-field-set">
		<h2>Story Format: <span>(Required)</span></h2>
		<div class="ignite-field-set-description">***Note: Announcement is for future use (not active).</div>
		<div class="news-format">
			<div class="ignite-field checkbox-field">
				<input id="feature-slideshow_placement_input" type="checkbox" name="_article_placement[]" value="feature-slideshow" <?php if ( in_array( 'feature-slideshow', $placement ) ) echo 'checked="checked"';?> />
				<label for="feature-slideshow_placement_input">Feature Slideshow</label>
			</div>
			<div class="ignite-field checkbox-field">
				<input id="news-feed_placement_input" type="checkbox" name="_article_placement[]" value="news-feed" <?php if ( in_array( 'news-feed', $placement ) ) echo 'checked="checked"';?> />
				<label for="news-feed_placement_input">News Article (News Feed)</label>
			</div>
			<div class="ignite-field checkbox-field">
				<input id="announcement_placement_input" type="checkbox" name="_article_placement[]" value="announcement" <?php if ( in_array( 'announcement', $placement ) ) echo 'checked="checked"';?> />
				<label for="announcement_placement_input">Announcement</label>
			</div>
		</div>
	</div>
	<div  class="ignite-field-set">
		<h2>Categorize This Story As: <span>(Required)</span></h2>
		<div class="ignite-field-set-description"><span>Check All That Apply.</span> Select all topics relevant to this story.</div>
		<div class="news-release-categories">
			<?php foreach( $general_topics as $name => $label ):?>
			<div class="ignite-field checkbox-field ignite-field-25 checkbox-list">
				<input id="<?php echo $name;?>_topic_input" type="checkbox" name="_article_topic[]" value="<?php echo $label;?>" <?php if ( in_array( $name, $topic_values ) || in_array( $label, $topic_values ) ) echo 'checked="checked"';?> />
				<label for="<?php echo $name;?>_topic_input"><?php echo $label;?></label>
			</div>
			<?php endforeach;?>
		</div>
	</div>
	<div  class="ignite-field-set">
		<h2>This Story is About: <span>(Required)</span></h2>
		<div class="ignite-field-set-description"><span>Check All That Apply.</span> Select the primary subject(s) of the story. If the story is about a faculty member then select "Faculty". Please use discretion with the subject areas. Do not select "Facilities & Centers" or 
		other subjects unless the story is actually about that subject.</div>
		<div class="news-release-categories">
			<?php foreach( $subjects as $name => $label ):?>
			<div class="ignite-field checkbox-field ignite-field-25 checkbox-list">
				<input id="<?php echo $name;?>_subject_input" type="checkbox" name="_article_subject[]" value="<?php echo $label;?>" <?php if ( in_array( $name, $subjects_values) || in_array( $label, $subjects_values ) ) echo 'checked="checked"';?> />
				<label for="<?php echo $name;?>_subject_input"><?php echo $label;?></label>
			</div>
			<?php endforeach;?>
		</div>
	</div>
	<div  class="ignite-field-set">
		<h2>Slide Options</h2>
		<div class="ignite-field text-field">
			<label>Short Title: <span>(Optional)</span></label>
			<div class="description">Short title used in slideshows and other areas where text is limited.</div>
			<input type="text" name="_article_short_title" value="<?php echo $short_title;?>" />
		</div>
		<div class="ignite-field text-field">
			<label>Redirect URL: <span>(Optional)</span></label>
			<div class="description">Redirect to a story posted somewhere else.</div>
			<input type="text" name="_article_redirect_url" value="<?php echo $redirect_url;?>" />
		</div>
	</div>
</div>