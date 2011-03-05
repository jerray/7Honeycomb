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
						<?php if(has_post_thumbnail()):?>
							<?php the_post_thumbnail();?>
						<?php endif;?>
						<?php the_excerpt(); ?>
					</div>
					<p class="postmetadata">
						<?php _e('分类&#58;'); ?>
						<?php the_category(',') ?>
						<?php comments_popup_link('&nbsp;&nbsp;没有评论 &#187;', '&nbsp;&nbsp;1 条评论 &#187;', '&nbsp;&nbsp;% 条评论 &#187;');?>
						<?php edit_post_link('&nbsp;&nbsp;编辑', ' &#124; ', ''); ?>
					</p>
				</div>
			</div>
		<?php endwhile;?>
		<div class="navigation">
			<?php if(function_exists('wp_pagenavi')):?>
				<?php wp_pagenavi();?>
			<?php else: ?>
				<?php posts_nav_link(); ?>
			<?php endif;?>
		</div>
	<?php endif;?>
</div><!--container-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
