<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
	<table>
		<tr>
		<td><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="searchtext" /></td>
		<td><input type="image" id="searchsubmit" value="Search" src="<?php bloginfo('template_url');?>/images/search.png" /></td>
		</tr>
	</table>
</form>