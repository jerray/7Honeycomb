<?php

add_theme_support( 'nav_menus' );
function register_my_menus() {
	if (function_exists('register_nav_menu'))
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'primary' ),
		) );
}
add_action( 'init', 'register_my_menus' );


function register_my_sidebar() {
	if (function_exists('register_widget')){
		register_sidebar(array(
			'name' => 'Top Widgets',
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>',
			'before_title' => '<h2 class="widgettitle">',
			'after_title' => '</h2>',
		));
		register_sidebar(array(
			'name' => 'Center Widgets',
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>',
			'before_title' => '<h2 class="widgettitle">',
			'after_title' => '</h2>',
		));
		register_sidebar(array(
			'name' => 'Bottom Widgets',
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>',
			'before_title' => '<h2 class="widgettitle">',
			'after_title' => '</h2>',
		));
	}
}
add_action( 'init', 'register_my_sidebar' );

add_theme_support( 'post-thumbnails' );

/* Admin Menu start:*/
class CustomOptions{
	
	function getOptions(){
		$options = get_option('7Honeycomb_options');
		
		if(!is_array($options)){
			$options = array(
				'use_logo' => true,
				'logo_url' => 'logo.png',
				'use_favicon' => false,
				'favicon_url' => '',
			);
			
			update_option('7Honeycomb_options', $options);
		}
		
		return $options;
	}
	
	function init(){
		if(isset($_POST['7Honeycomb_save'])){
			$options = CustomOptions::getOptions();
			if($_POST['use_logo']){
				$options['use_logo'] = (bool) true;
			} else {
				$options['use_logo'] = (bool) false;
			}
			$options['logo_url'] = stripslashes($_POST['logo_url']);
			
			if($_POST['use_favicon']){
				$options['use_favicon'] = (bool) true;
			} else {
				$options['use_favicon'] = (bool) false;
			}
			$options['favicon_url'] = stripslashes($_POST['favicon_url']);
			
			update_option('7Honeycomb_options', $options);
		} else {
			CustomOptions::getOptions();
		}
		
		add_theme_page("主题选项", "主题选项", 'edit_themes', basename(__FILE__), array('CustomOptions', 'display'));
	}
	
	function display(){
		$options = CustomOptions::getOptions();
		?>
		<form action="#" method="POST" enctype="multipart/form-data">
			<div class="wrap">
				<div class="config_box">
					<h3><?php _e('Title config', '7Honeycomb'); ?></h3>
					<p><label><input name="use_logo" type="checkbox" value="checkbox" <?php if($options['use_logo']) echo 'checked="checked"';?> /><?php _e('Use image logo.', '7Honeycomb');?></label></p>
					<p><label>Logo image file name: <input name="logo_url" type="text" value="<?php if($options['logo_url']) echo $options['logo_url']; ?>" /></label>( Don't forget to upload image to, wp-content/themes/7Honeycomb/images/ )</p>
				</div>
				<div class="config_box">
					<h3><?php _e('Favicon config', '7Honeycomb'); ?></h3>
					<p><label><input name="use_favicon" type="checkbox" value="checkbox" <?php if($options['use_favicon']) echo 'checked="checked"';?> /><?php _e('Use favicon.', '7Honeycomb');?></label></p>
					<p><label>Favicon file name: <input name="favicon_url" type="text" value="<?php if($options['favicon_url']) echo $options['favicon_url']; ?>" /></label>( Don't forget to upload favicon to your wordpress root )</p>
				</div>
				<p class="submit">
					<input type="submit" name="7Honeycomb_save" value="<?php _e('Update Options &raquo;', '7Honeycomb'); ?>" />
				</p>
			</div>
		</form>
		<?php
	}
}
add_action('admin_menu', array('CustomOptions', 'init'));
/* Admin Menu end*/

/* Widgets begin:*/
class Welcome_And_Custom_Feed_Url extends WP_Widget{

	function Welcome_And_Custom_Feed_Url(){
		//register the widget
		$widget_options = array(
			'description' => '您可以通过这个插件修改欢迎信息，更换Feed和Twitter图标所指向的链接。',
			'classname' => 'welcome-info',
		);
		$control_options = array(
			'width' => '230px',
		);
		$this->WP_Widget('welcome-and-custom-feed-url-widget', '欢迎信息', $widget_options, $control_options);
	}
	
	function widget($args, $instance){
		//output the content of the widget
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$text = $instance['text'];
		$feed = $instance['feed'];
		$twitter = $instance['twitter'];
		
		echo $before_widget;
		if($title){
			echo $before_title . $title . $after_title;
		}
		?>
		
		<div id="social">
			<?php if($text):?>
			<div class="welcome"><?php echo $text; ?></div>
			<?php endif;?>
			<table>
				<tr>
					<td><a class="rss-feed" title="订阅我吧"href="<?php if($feed){echo $feed;}else{bloginfo( 'rss2_url' );}?>" target="_blank"><span class="hover">Feed Me</span></a></td>
					<td><a class="twitter-link" title="Follow me on Twitter" href="<?php if($twitter){echo $twitter;}else{echo 'https://twitter.com';}?>" target="_blank"><span class="hover">Follow Me</span></a></td>
				</tr>
			</table>
		</div>
		
		<?php
		echo $after_widget;
	}
	
	function form($instance){
		//output the admin options form
		$defaults = array(
			'title' => 'Welcome',
			'text' => 'Welcome to my blog.',
			'feed' => '',
			'twitter' => 'https://twitter.com',
		);
		
		$instance = wp_parse_args((array)$instance, $defaults);
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title');?></label>
		<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" type="text" class="widefat" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('feed'); ?>"><?php _e('Feed URL:'); ?></label>
		<input id="<?php echo $this->get_field_id('feed'); ?>" name="<?php echo $this->get_field_name('feed'); ?>" value="<?php echo $instance['feed']; ?>" type="text" class="widefat" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:'); ?></label>
		<input id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $instance['twitter']; ?>" type="text" class="widefat" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Description:(HTML)'); ?></label>
		<textarea id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" rows="10" class="widefat"><?php echo $instance['text']; ?></textarea>
		</p>
		<?php
	}
	
	function update($new_instance, $old_instance){
		//processes the admin options form when saved
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['feed'] = strip_tags($new_instance['feed']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		
		return $instance;
	}
}
add_action('widgets_init', create_function('', 'return register_widget("Welcome_And_Custom_Feed_Url");'));


?>
