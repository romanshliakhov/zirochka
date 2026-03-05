<?php function clean_the_content() {
	$content = apply_filters('the_content', get_the_content());
	$content = preg_replace('/<p>\s*<\/p>/i', '', $content);
	echo $content;
}
