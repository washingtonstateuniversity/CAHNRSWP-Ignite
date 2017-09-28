<div class="locations-edit-form">
	<div class="content-type">
		<h2>Categorize This Story As:</h2>
		<div class="description"><span>Check All That Apply.</span> Select all topics relevant to this story.</div>
		<ul class="news-release-categories">
			<?php foreach( $general_topics as $name => $label ):?>
			<div class="ignite-field tab-field">
				<input id="<?php echo $name;?>_category_input" type="checkbox" name="_news_release_categories[]" value="<?php echo $name;?>" <?php if ( in_array( $name, $categories_values) ) echo 'checked="checked"';?> />
				<label for="<?php echo $name;?>_category_input"><?php echo $label;?></label>
			</div>
			<?php endforeach;?>
		</ul>
	</div>
	<div class="subject-type">
		<h2>This Story is About:</h2>
		<div class="description"><span>Check All That Apply.</span> Select the primary subject(s) of the story. If the story is about a faculty member then select "Faculty". Please use discrestion with the subject areas. Do not select "Facilities & Centers" or 
		other subjects unless the story is actually about that subject.</div>
		<ul class="news-release-categories">
			<?php foreach( $subjects as $name => $label ):?>
			<div class="ignite-field tab-field">
				<input id="<?php echo $name;?>_subjects_input" type="checkbox" name="_news_release_subjects[]" value="<?php echo $name;?>" <?php if ( in_array( $name, $subjects_values) ) echo 'checked="checked"';?> />
				<label for="<?php echo $name;?>_subjects_input"><?php echo $label;?></label>
			</div>
			<?php endforeach;?>
		</ul>
	</div>
</div>