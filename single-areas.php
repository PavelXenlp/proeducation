<?php
wp_head();
get_header();

$page_id = get_the_ID();
$page_title = get_the_title($page_id);
$page_excerpt = get_the_excerpt($page_id);
$page_content = get_the_content(null, false, $page_id);
$thumb = get_the_post_thumbnail_url($page_id, 'large');
?>
</main>
<div class="pageMargin"></div>

<?php
include __DIR__ . '/includes/program-page/programPageTop.php';
include __DIR__ . '/includes/program-page/programPageList.php';
include __DIR__ . '/includes/requestBlock.php';
?>

<?php
get_footer();
wp_footer();
?>