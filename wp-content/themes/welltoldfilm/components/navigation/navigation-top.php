<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-collapse">
      	<span class="sr-only">Toggle navigation</span>
      	<span class="icon-bar"></span>
      	<span class="icon-bar"></span>
      	<span class="icon-bar"></span>
      </button>
    </div>
    <div class="navbar-collapse collapse">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_class' => 'nav navbar-nav navbar-right' ) ); ?>
		</div>
        <!-- nav -->
  </div>
      <!-- end nav container-->
</nav><!-- #site-navigation -->
