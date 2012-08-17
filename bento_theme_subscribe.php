<?php 
/**
 * Bento subscribe widget
 */

class bento_theme_subscribe extends WP_Widget {
	function bento_theme_subscribe () {
			parent::WP_Widget(false, $name = __('bento Subscribe','bento_theme'), $widget_options = array('description' => __('A nice look subscribe widget with control options','bento_theme')));		
		}
	function widget($args,$instance) {
			extract( $args );
			
			// Backend Options 
			$title = apply_filters('widget_title',$instance['title']);
			$twitter_id = $instance['twitter_id'];
			$plurk_id = $instance['plurk_id'];
			$facebook_url = $instance['facebook_url'];
			$rss_url = $instance['rss_url'];
			$googleplus_url = $instance['googleplus_url'];
			
			echo $before_widget;
			
			// Frontend
		   if ($title) {
		   		echo $before_title. $title . $after_title;
		   	}
		   else {
				echo $before_title. "Subscribe" . $after_title;
			}

			echo '<ul style="display:block;">';
		   	
		   if ($twitter_id) {
		   		echo '<li style="float:left;">';
		   		echo '<a href="https://twitter.com/#!/'.$twitter_id.'">';
		   		echo '<img src="'.get_bloginfo('template_url').'/images/geeko-twitter.png"/>';
		   		echo '</a></li>'; 
		   	}	
		   	
		   if ($plurk_id) {
		   		echo '<li style="float:left;">';
		   		echo '<a href="http://www.plurk.com/'.$plurk_id.'">';
		   		echo '<img src="'.get_bloginfo('template_url').'/images/geeko-plurk.png"/>';
		   		echo '</a></li>'; 
		   	}		
		   	
		   if ($facebook_url) {
		   		echo '<li style="float:left;">';
		   		echo '<a href="'.$facebook_url.'">';
		   		echo '<img src="'.get_bloginfo('template_url').'/images/geeko-facebook.png"/>';
		   		echo '</a></li>'; 
		   	}
		   	
		   if ($rss_url) {
		   		echo '<li style="float:left;">';
		   		echo '<a href="'.$rss_url.'">';
		   		echo '<img src="'.get_bloginfo('template_url').'/images/geeko-rss.png"/>';
		   		echo '</a></li>'; 
		   	}
		   else {
				echo '<li style="float:left;">';
		   		echo '<a href="'.get_bloginfo('url').'/feed/">';
		   		echo '<img src="'.get_bloginfo('template_url').'/images/geeko-rss.png"/>';
		   		echo '</a></li>'; 
		   }
		   	
		   if ($googleplus_url) {
		   		echo '<li style="float:left;">';
		   		echo '<a href="'.$googleplus_url.'">';
		   		echo '<img src="'.get_bloginfo('template_url').'/images/geeko-googleplus.png"/>';
		   		echo '</a></li>'; 
		   	}
			
			echo "</ul>";
			
			echo '<div style="clear:both;"/>';
			
			echo $after_widget;
		}
		
	function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);	
			$instance['twitter_id'] = strip_tags($new_instance['twitter_id']);
			$instance['plurk_id'] = strip_tags($new_instance['plurk_id']);
			$instance['facebook_url'] = strip_tags($new_instance['facebook_url']);
			$instance['rss_url'] = strip_tags($new_instance['rss_url']);
			$instance['googleplus_url'] = strip_tags($new_instance['googleplus_url']);
			return $instance;	
		}
	function form($instance) {
			$title = esc_attr($instance['title']);
			$twitter_id = esc_attr($instance['twitter_id']);
			$plurk_id = esc_attr($instance['plurk_id']);
			$facebook_url = esc_attr($instance['facebook_url']);
			$rss_url = esc_attr($instance['rss_url']);
			$googleplus_url = esc_attr($instance['googleplus_url']);
			
			?>
			
<p>
	<label for="<?php echo $this->get_field_id('title');?>"><b><?php _e('Widget Title','bento_theme');?></b></label>
	<small style="display:block;color:#9c0;"><?php _e('In case you want a different title like "订阅"','bento_theme'); ?></small>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
</p>	

<p>
	<label for="<?php echo $this->get_field_id('twitter_id');?>"><b><?php _e('Twitter Username','bento_theme');?></b></label>
	<small style="display:block;color:#9c0;"><?php _e('Your <a style="color:#9c0" href="https://twitter.com">Twitter</a> ID','bento_theme');?></small>
	<input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter_id; ?>"/>
</p>		

<p>
	<label for="<?php echo $this->get_field_id('plurk_id');?>"><b><?php _e('Plurk Username','bento_theme');?></b></label>
	<small style="display:block;color:#9c0;"><?php _e('Your <a style="color:#9c0" href="http://plurk.com">Plurk</a> ID','bento_theme'); ?></small>
	<input class="widefat" id="<?php echo $this->get_field_id('plurk_id'); ?>" name="<?php echo $this->get_field_name('plurk_id'); ?>" type="text" value="<?php echo $plurk_id; ?>"/>
</p>

<p>
	<label for="<?php echo $this->get_field_id('facebook_url');?>"><b><?php _e('Facebook URL','bento_theme');?></b></label>
	<small style="display:block;color:#9c0;"><?php _e('Your <a style="color:#9c0" href="http://facebook.com">Facebook</a> timeline url','bento_theme'); ?></small>
	<input class="widefat" id="<?php echo $this->get_field_id('facebook_url'); ?>" name="<?php echo $this->get_field_name('facebook_url'); ?>" type="text" value="<?php echo $facebook_url; ?>"/>
</p>

<p>
	<label for="<?php echo $this->get_field_id('rss_url');?>"><b><?php _e('RSS URL','bento_theme');?></b></label>
	<small style="display:block;color:#9c0;"><?php _e('In case you use an external feed like <a style="color:#9c0" href="http://feedburner.com">feedburner</a>','bento_theme'); ?></small>
	<input class="widefat" id="<?php echo $this->get_field_id('rss_url'); ?>" name="<?php echo $this->get_field_name('rss_url'); ?>" type="text" value="<?php echo $rss_url; ?>"/>
</p>

<p>
	<label for="<?php echo $this->get_field_id('googleplus_url');?>"><b><?php _e('Google Plus URL','bento_theme');?></b></label>
	<small style="display:block;color:#9c0;"><?php _e('Your <a style="color:#9c0" href="http://plus.google.com">Google+</a> profile url','bento_theme'); ?></small>
	<input class="widefat" id="<?php echo $this->get_field_id('googleplus_url'); ?>" name="<?php echo $this->get_field_name('googleplus_url'); ?>" type="text" value="<?php echo $googleplus_url; ?>"/>
</p>
			
			<?php		
	} // end backend form

} // end bento_subscribe class
	
// activate
add_action('widgets_init', create_function('','return register_widget("bento_theme_subscribe");'));	

?>
 
