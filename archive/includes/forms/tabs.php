<nav class="tab-form-ignite">
	<?php $t = 0; foreach( $tab_set as $title => $html ):?>
    <a href="#" class="<?php if( $t == 0 ) echo 'active'; $t++?>"><?php echo $title;?></a>
    <?php endforeach;?>
</nav>
<div class="tab-form-sections-ignite">
	<?php $c = 0; foreach( $tab_set as $title => $html ):?>
    <div class="<?php if( $c == 0 ) echo 'active'; $c++ ?>"><?php echo $html;?></div>
    <?php endforeach;?>
</div>