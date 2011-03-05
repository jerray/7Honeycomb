<div class="sidebar">
    <ul>
    <?php if (function_exists('dynamic_sidebar')&& dynamic_sidebar('Top Widgets')):else:?>
		<li class="widget">
			<div id="social">
			<table>
				<tr>
					<td><a id="rss-feed" title="订阅我吧" href="<?php bloginfo( 'rss2_url' );?>" target="_blank"><img alt="" src="<?php bloginfo( 'url' );?>/wp-content/themes/7honeycomb/images/feed2.png" /></a></td>
					<td><a title="Follow me on Twitter" href="https://twitter.com" target="_blank"><img alt="" src="<?php bloginfo( 'url' );?>/wp-content/themes/7honeycomb/images/tw1.png" /></a></td>
				</tr>
			</table>
			</div>
			<?php get_search_form(); ?>
		</li>
	<?php endif; ?>
	
	<?php if (function_exists('dynamic_sidebar')&& dynamic_sidebar('Center Widgets')):else:?>
		<li class="widget">
            <h2 class="widgettitle"><?php _e('Calendar'); ?></h2>
            <?php get_calendar(); ?>
        </li>
		<li class="widget">
			<h2 class="widgettitle"><?php _e('Tags'); ?></h2>
			<ul><?php wp_tag_cloud('smallest=10&largest=22&number=30&orderby=count');?></ul>
		</li>
        <li class="widget">
            <h2 class="widgettitle"><?php _e('Categories'); ?></h2>
            <ul>
                <?php wp_list_cats('sort_column=name&optioncount=1&hierarchial=0'); ?>
            </ul>
        </li>
		<?php get_links_list(); ?>
        <li class="widget">
            <h2 class="widgettitle"><?php _e('Archives'); ?></h2>
            <ul>
                <?php wp_get_archives('type=monthly'); ?>
            </ul>
        </li>
	<?php endif; ?>
	
	<?php if (function_exists('dynamic_sidebar')&& dynamic_sidebar('Bottom Widgets')):else:?>
        <li class="widget">
            <h2 class="widgettitle"><?php _e('Meta');?></h2>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </li>
    <?php endif; ?>
    </ul>
</div><!--sidebar-->