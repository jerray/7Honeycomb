<?php // Do not delete these lines

if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thanks!');

if (!empty($post->post_password)) { // if there's a password

	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie

?>

<h2><?php _e('Password Protected'); ?></h2>

<p><?php _e('Enter the password to view comments.'); ?></p>

<?php return;
	}
}
	/* This variable is for alternating comment background */
$oddcomment = 'alt';

?>

<!-- You can start editing here. -->
<div class="comment-respond">
<?php if ($comments) : ?>

	<h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

<ol class="commentlist">
	<?php wp_list_comments(); ?>
</ol>

<?php else : // this is displayed if there are no comments so far ?>

<?php if ('open' == $post->comment_status) : ?>

	<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>

	<!-- If comments are closed. -->

<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>

<?php endif; ?>
</div>

<div class="comment-respond">
<?php if ('open' == $post->comment_status) : ?>
		<h3 id="respond-title">评论这篇文章</h3>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</p>

<?php else : ?>

<div id="respond">
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php comment_id_fields(); ?>
<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="40" tabindex="1" />

<label for="author"><small>名字 <?php if ($req) echo "(必填)"; ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="40" tabindex="2" />

<label for="email"><small>E-Mail (不会被公开) <?php if ($req) echo "(必填)"; ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="40" tabindex="3" />

<label for="url"><small>网站</small></label></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> <?php _e('You can use these tags&#58;'); ?> <?php echo allowed_tags(); ?></small></p>-->

<p><textarea name="comment" id="comment" cols="60" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="提交评论" />

<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

</p>

<?php do_action('comment_form', $post->ID); ?>

</form>
</div>
</div>
<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>