<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<title><?php bloginfo( 'name' );?><?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' );?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo( 'version' );?>" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' );?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo( 'rss2_url' );?>" />
	<link rel="alternate" type="text/xml" title="RSS.92" href="<?php bloginfo( 'rss_url' );?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo( 'atom_url' );?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
	
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by defalut ?>
	<?php
		if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	?>
	<?php wp_head(); ?>
</head>
</head>
<body>
<div id="wrapper">
<div id="header">
	<div class="title">
		<div class="blog-name"><h1><a href="<?php bloginfo( 'url' );?>"><?php bloginfo('name');?></a></h1></div>
		<span><?php bloginfo( 'description' );?></span>
	</div>
	<div class="user_menu">
		<?php wp_nav_menu(array( 'container_class' => 'menu-header', 'theme_location' => 'primary', )); ?>
	</div>
	<div class="menubar">
		<ul id="menus" class="menus"><?php if (is_home()) {$home_menu_class = 'current_page_item';} else {$home_menu_class = 'page_item';}?>
			<li class="<?php echo($home_menu_class); ?>"><a title="<?php _e('Home', 'default'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'default'); ?></a></li>
			<?php wp_list_categories('depth=0&title_li=0&orderby=name&show_count=0'); ?>
		</ul>
	</div>
</div><!--header-->