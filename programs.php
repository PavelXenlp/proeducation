<?php
/**
 * Template Name: Все программы
 */

wp_head();
get_header();

$page_id = get_the_ID();
$page_title = get_the_title($page_id);
$page_excerpt = get_the_excerpt($page_id);

$areas = get_posts(array(
    'post_type' => 'areas',
    'numberposts' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC'
));

?>
</main>
<div class="pageMargin"></div>

<?php

include __DIR__ . '/includes/programs-page/titleBlock.php';
include __DIR__ . '/includes/programs-page/programsBlock.php';
include __DIR__ . '/includes/requestBlock.php';

get_footer();
wp_footer();
?>