<?php

/**
 * Template Name: Main Page
 *
 * @package CUSTOM THEME
 * @since 1.0.0
 */
wp_head();
get_header();
?>

<?php include __DIR__ . '/includes/main-page/mainBlock.php'; ?>
<?php include __DIR__ . '/includes/main-page/mainDirectionsBlock.php'; ?>
<?php include __DIR__ . '/includes/main-page/mainDocumentsBlock.php'; ?>
<?php include __DIR__ . '/includes/main-page/mainReviews.php'; ?>
<?php include __DIR__ . '/includes/faqBlock.php'; ?>
<?php include __DIR__ . '/includes/main-page/mainAboutBlock.php'; ?>
<?php include __DIR__ . '/includes/main-page/mainCertsBlock.php'; ?>
<?php include __DIR__ . '/includes/main-page/mainPartnersBlock.php'; ?>
<?php include __DIR__ . '/includes/main-page/mainNews.php'; ?>
<?php include __DIR__ . '/includes/requestBlock.php'; ?>
<?php include __DIR__ . '/includes/main-page/mainCompanies.php'; ?>

<?php
get_footer();
wp_footer();
?>