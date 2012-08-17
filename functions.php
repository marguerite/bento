<?php

function remote_theme_url ($action="") {
  $theme_url      = "http://static.opensuse.org/themes/bento";
  $includes_dir   = "/includes/";
  $javescript_dir = "/js/";
  $css_dir        = "/css/";
  $images_dir     = "/images/";
  
  // return URL for further usage
  if (empty($action) || $action == "theme_url") {
    return $theme_url;
  }
  // echo URL => direct output
  if ($action == "get_theme_url") {
    echo $theme_url;
  }
  // global includes => Header, Footer, Sponsors, etc.
  if ($action == "include_url") {
    return $theme_url . $includes_dir;
  }
}

function get_remote_snippet ($snippet='') {
  if ($snippet == "header") { // output Header
    echo_snippet($snippet);
  }
  if ($snippet == "footer") { // output Footer
    echo_snippet($snippet);
  }
  if ($snippet == "footer-lizards") { // output Footer
    echo_snippet($snippet);
  }
  if ($snippet == "sponsors") { // output Sponsor Snippet
    echo_snippet($snippet);
  }
}

function echo_snippet ($source='') {
  if ($source) {
    $snippet_source = file(remote_theme_url('include_url') . $source . ".html");
    foreach ($snippet_source as $line) {
      echo $line;
    }
  } else {
    return false;
  }
}

// Enable Custom Menus
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ), // Main Menu
      // # Add the menus you need here. Look into header.php to see how to use it or look for wp_nav_menu() in the Wordpress Codex:
      // # http://codex.wordpress.org/Function_Reference/wp_nav_menu
      //'footer-menu' => __( 'Footer Menu' ), // Footer Menu
      //'sidebar-menu' => __( 'Sidebar Menu' ) // Sidebar Menu
      )
    );
  }
add_action( 'init', 'register_my_menus' );

// Enable Widgets for sidebar
if ( function_exists('register_sidebar') )
  register_sidebars(1, array(
    'name'=>'Sidebar %d',
    'before_widget' => '<li id="%1$s" class="widget box box-shadow %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="box-subheader">',
    'after_title' => '</h3>',
));

// Custom Comment for Bento-Theme 
function bento_theme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class('box grey'); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
         <?php printf(__('<strong><cite class="fn">%s</cite></strong>'), get_comment_author_link()) ?>
      </div>
            
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>
        
      </div>

      <div class="comment-meta commentmetadata">
        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
        |
        <?php edit_comment_link(__('Edit'),'  ','') ?>
      </div>

      <?php comment_text() ?>



      <div class="reply">
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
            <div class="clearfix">
     </div>

<?php } // end custom comment

// Count Down
if(function_exists('register_sidebar_widget'))
	register_sidebar_widget(__('openSUSE Count Down'),'bento_theme_countdown');
	
function bento_theme_countdown() {
	$output .= "<li class=\"widget box box-shadow widget_countdown\"><h3 class=\"box-subheader\">新版倒计时</h3>";
	$output .= "<a style=\"display:block;margin: 0 auto;width:130px;\" href=\"http://software.opensuse.org/developer/zh_CN\">";
	$output .= "<img src=\"".get_bloginfo('template_url')."/openSUSE12.2.png\"/></a></li>";
	echo $output;
}

// Lizards' author applet

if(function_exists('register_sidebar_widget'))
	register_sidebar_widget(__('Author Statistics'),'bento_theme_author_statistics');
	
function bento_theme_author_statistics() {
    global $wpdb;
	$bento_user_query = "SELECT ID, user_email, user_url, display_name FROM $wpdb->users";
	$bento_users = $wpdb->get_results($bento_user_query);
	
	// detect if we should use "lizards" or just "Authors"
	if (get_bloginfo('url') === "http://news.opensuse.org" || get_bloginfo('url') === "http://lizards.opensuse.org") {
		$widget_authors_title = "Lizards";
	} else {
		$widget_authors_title = "作者";
	}
	
	$output .= "<li class=\"widget box box-shadow widget_authors\"><h3 class=\"box-subheader\">".$widget_authors_title."</h3>";
	$output .= "<ul>";
	foreach ($bento_users as $bento_user) {
		$output .= "<li>";
		$output .= get_avatar($bento_user->user_email,32);
		if ($bento_user->user_url != "") {
		$output .= "<a title=\"Posts by ".$bento_user->display_name."\" href=\"".$bento_user->user_url."\">";
		$output .= $bento_user->display_name;
		$output .= "</a>";
		} else {	
		$output .= $bento_user->display_name;
		} 
		$output .= " (".count_user_posts($bento_user->ID).") ";
		$output .= "</li>";
	}
	$output .= "</ul></li>";
	echo $output;
}

//include bento_theme_subscribe
include "bento_theme_subscribe.php";

?>