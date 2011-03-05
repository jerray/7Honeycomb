<?php get_header(); ?>

<div id="container">
	<?php if(have_posts()):?>
		<?php while(have_posts()): the_post();?>
			<div class="post">
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<div class="entry">
					<p class="postmetadata">
						<?php the_author();?>&nbsp;发表于&nbsp;<?php the_time('Y年 n月 j日'); ?>
					</p>
					<div class="post-content">
						<?php the_content(); ?>
					</div>
					<?php link_pages('<p><strong>Pages:</strong>', '</p>', 'number'); ?>
					<p class="postmetadata">
						<?php _e('分类&#58;'); ?>
						<?php the_category(',') ?>
						<?php edit_post_link('编辑', ' &#124; ', ''); ?>
					</p>
				</div>
				<div class="comments-template">
					<?php comments_template(); ?>
				</div>
			</div>
		<?php endwhile;?>
		<div class="navigation">
			<div class="previous-post-link"><p><?php previous_post_link(' &laquo; %link') ?></p></div>
			<div class="next-post-link"><p><?php next_post_link(' %link &raquo;') ?></p></div>
		</div>
	<?php endif;?>
</div><!--container-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

