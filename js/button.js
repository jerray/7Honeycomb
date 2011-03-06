jQuery(document).ready(function() {
	jQuery('.rss-feed, .twitter-link').wrapInner('<span class="hover"></span>').css('textIndent','0')
		.each(function () {
			jQuery('span.hover').css('opacity', 0).hover(function () {
				jQuery(this).stop().fadeTo(650, 1);
		}, function () {
				jQuery(this).stop().fadeTo(650, 0);
		});
	});
});