<?php

/**
 * Template Name: Программы магистратуры
 *
 * @package CUSTOM THEME
 * @since 1.0.0
 */
wp_head();
get_header();

$page_id = get_the_ID();
$page_title = get_the_title($page_id);
$page_excerpt = get_the_excerpt($page_id);

?>
</main>
<div class="pageMargin"></div>

<?php

include __DIR__ . '/includes/programs-page/titleBlock.php';
include __DIR__ . '/includes/news-page/newsList.php';
include __DIR__ . '/includes/requestBlock.php';

get_footer();
wp_footer();
?>