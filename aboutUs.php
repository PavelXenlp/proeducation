<?php

/**
 * Template Name: О нас
 *
 * @package CUSTOM THEME
 * @since 1.0.0
 */
wp_head();
get_header();
?>
</main>
<div class="pageMargin"></div>
<?php include __DIR__ . '/includes/main-page/mainAboutBlock.php'; ?>
<?php include __DIR__ . '/includes/main-page/mainCertsBlock.php'; ?>
<?php include __DIR__ . '/includes/aboutUs-page/aboutUsResults.php'; ?>
<?php include __DIR__ . '/includes/main-page/mainPartnersBlock.php'; ?>
<?php include __DIR__ . '/includes/main-page/mainReviews.php'; ?>
<?php include __DIR__ . '/includes/requestBlock.php'; ?>

<?php
get_footer();
wp_footer();
?>