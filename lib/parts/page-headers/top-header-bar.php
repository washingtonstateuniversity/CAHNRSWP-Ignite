<div id="global-top-header-bar" class="site-header">
    <nav class="top-header-bar-primary-nav">
       <?php if ( is_active_sidebar( 'global-top-header-bar-primary' ) ): dynamic_sidebar( 'global-top-header-bar-primary' ); ?>
       <?php else:?>
        <ul>
            <li class="college-name-logo">
                <a href="//cahnrs.wsu.edu">
					C<span>ollege of </span>A<span>gricultural, </span>H<span>uman, and </span>N<span>atural </span>R<span>esource </span>S<span>ciences</span>
                </a>
            </li>
        </ul>
        <?php endif;?>
    </nav><nav class="top-header-bar-secondary-nav">
        <?php if ( is_active_sidebar( 'global-top-header-bar-secondary' ) ): dynamic_sidebar( 'global-top-header-bar-secondary' ); ?>
       	<?php else:?>
        <a href="http://admission.wsu.edu/applications/index.html">Apply</a><a href="http://cahnrs.wsu.edu/academics/prospective/">Request Info</a><a href="https://secure.wsu.edu/give/default.aspx?fund=311">Give</a>
        <?php endif;?>
    </nav>
</div>
