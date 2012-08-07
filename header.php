<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


  <!-- include local CSS file -->
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <link rel="stylesheet" href="http://static.opensuse.org/themes/bento/css/print.css" type="text/css" media="print" />

  <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <!-- opengraph metadata -->
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
  <?php
  if ( is_home() ) {
  echo '<meta property="og:type" content="blog" />'; echo "\n";
  echo '  <meta property="og:title" content="'; bloginfo('name'); echo '" />'; echo "\n";
  echo '  <meta property="og:url" content="'; bloginfo('url'); echo '" />'; echo "\n";
  echo '  <meta property="og:description" content="'; bloginfo('description'); echo '" />'; echo "\n";
  } else {
  echo '<meta property="og:type" content="article" />'; echo "\n";
  echo '  <meta property="og:title" content="'; the_title(); echo '" />'; echo "\n";
  echo '  <meta property="og:url" content="'; the_permalink();  echo '" />'; echo "\n";
  echo '  <meta property="og:description" content="'; the_excerpt_rss(); echo '" />'; echo "\n";
  }
  ?>

  <!-- include JS from static.opensuse.org -->
  <script src="<?php remote_theme_url('get_theme_url'); ?>/js/jquery.js" type="text/javascript" charset="utf-8"></script>
  <script src="<?php remote_theme_url('get_theme_url'); ?>/js/script.js" type="text/javascript" charset="utf-8"></script>
  <!-- This is for local development:
  <script src="<?php echo get_bloginfo('template_url'); ?>/js/script.js" type="text/javascript" charset="utf-8"></script>
  -->

  <!-- translated global navigation -->
  <script src="<?php remote_theme_url('get_theme_url'); ?>/js/l10n/global-navigation-data-en_US.js" type="text/javascript" charset="utf-8"></script>
  <script src="<?php remote_theme_url('get_theme_url'); ?>/js/global-navigation.js" type="text/javascript" charset="utf-8"></script>

  <!-- social service scripts -->
  <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

  <!-- entry centered image auto resize scripts -->
  <script type="text/javascript" src="<?php get_template_directory_uri();?>/resize.js"></script>

  <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'your-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
  <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'your-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  
  <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
  <?php wp_head(); ?>
  
  <link rel="icon" type="image/png" href="http://static.opensuse.org/themes/bento/images/favicon.png" />
  <title><?php echo bloginfo('name'); ?></title>
  
</head>

<body>
  
  <!-- include header from static -->
  <?php #get_remote_snippet('header'); ?>
  
  <!-- Start: Header -->
  <div id="header">
    
    <div id="header-content" class="container_12">
      
      <a id="header-logo" href="http://www.opensuse.org">
        <img src="http://static.opensuse.org/themes/bento/images/header-logo.png" width="46" height="26" alt="Header Logo" />
      </a>
      
      <?php // Main Navigation

      // To enable the custom navigation uncomment the next code block ==> Custom Menu (Next 21 Lines)
      // and remove the openSUSE Global Navigation ==> ul#global-navigation
      /*
      // Custom Menu
      $menu_args =  array(
        'menu'            => '', 
        'container'       => '',
        'container_id'    => '', 
        'container_class' => '', 
        'menu_class'      => '',
        'menu_id'         => 'global-navigation',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'depth'           => 1,
        'walker'          => '',
        'theme_location' => 'header-menu'
        );
       wp_nav_menu( $menu_args );
       */
       ?>
      
      <?php // Start: openSUSE Global navigation ?>
      <ul id="global-navigation">
        <li id="item-downloads"><a href="http://opensuse.org/sitemap#downloads">Downloads</a></li>
        <li id="item-support"><a href="http://opensuse.org/sitemap#support">Support</a></li>
        <li id="item-community"><a href="http://opensuse.org/sitemap#community">Community</a></li>
        <li id="item-development"><a href="http://opensuse.org/sitemap#development">Development</a></li>
      </ul>
      <?php // End: openSUSE Global navigation ?>

      <?php get_search_form(); ?>
    
    </div>
  </div>
  <!-- End: Header -->

  <div id="subheader" class="container_12">
    <div id="breadcrump" class="grid_8 alpha">
      <!-- This will at first try detect if it's openSUSE official sites, if not, then 
      	display a self page level navigation for better display your own site names.
      	-->
      <?php // for openSUSE official sites ?>
      <?php if (get_bloginfo('url') === "http://news.opensuse.org" || get_bloginfo('url') === "http://lizards.opensuse.org") { ?>
      	<a href="<?php bloginfo('url');?>"><img src="http://static.opensuse.org/themes/bento/images/home_grey.png" width="16" height="16" alt="Home" /></a> <?php echo do_shortcode('[simple_crumbs root="Home" /]') ?>
      <?php } else { // for normal personal blog?>
      	<a style="display:inline-block;" href="<?php bloginfo('url');?>">
      	<img src="http://static.opensuse.org/themes/bento/images/home_grey.png" width="16" height="16" alt="Home" />
      	<?php if( is_home() ) {//see if home ?>
      		<?php bloginfo('name'); ?>
      	<?php } elseif ( is_single() ) {// see if single ?>
      		<?php bloginfo('name');?> </a> / 
      		<?php 
				$category = get_the_category(); 
				if($category[0]){
					echo '<a style="display:inline-block;" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
			} ?> / 
			<?php the_title(); ?>
		<?php } elseif ( is_category() ) {// see if category ?>
      		<?php bloginfo('name');?> </a> / 
      		<?php 
				$category = get_the_category(); 
				if($category[0]){
					echo '<a style="display:inline-block;" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
			} ?> 
		<?php } elseif ( is_tag()) {// see if tag ?>
			<?php bloginfo('name');?> </a> /
			<?php
				$posttags = get_the_tags();
				$count=0;
				if ($posttags) {
  					foreach($posttags as $tag) {
    					$count++;
    					if (1 == $count) {
      						echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>' . ' ';
    					}
  					}
				}
			?>
		<?php } elseif ( is_search()) {// see if search ?>
		</a> search results:
      	<?php } elseif ( is_page()) {// see if page ?>
      		<?php bloginfo('name');?> </a> /
      		<?php
				$parent_title = get_the_title($post->post_parent);
				echo $parent_title;
			?>
      	<?php } else { // elsewise ?>
      		<?php bloginfo('name');?> / Command not found. </a>
      	<?php } // end page class detection?>
      	<?php } // end normal personal blog?>
    </div>
    
    <?php #if (!current_user_can('level_0')) { // show login ?>
      
    <?php if ( is_user_logged_in() ) { // Show Logout ?>
      <div class="grid_4" id="login-wrapper">
        <a href="<?php echo get_bloginfo('url'); ?>/wp-admin/" title="WP-Admin-Interface">Backend</a> |
        <a href="<?php echo wp_logout_url(); ?>">Logout</a>
      </div>
    <?php } else { // Show Login ?>
      <div class="grid_4" id="login-wrapper">
        <a href="#signup-page">Sign up</a> | 
        <!-- <a id="login-trigger" href="" title="Login">Login</a> -->
        <!-- wp_login_form() ==> http://codex.wordpress.org/Function_Reference/wp_login_form -->
        <a href="<?php echo wp_login_url(); ?>" title="Login">Login</a>
      </div>
    <?php } ?>
  </div>
