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

$all_areas = get_posts([
    'post_type'      => 'areas',
    'numberposts'    => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
]);

$filtered_areas = [];

foreach ($all_areas as $area) {
    $related_programs = get_field('programs', $area->ID);
    
    if (!$related_programs || !is_array($related_programs)) {
        continue;
    }

    $bachelor_programs = [];

    foreach ($related_programs as $program_post) {
        $prog_level_edu = get_field('prog_level_edu', $program_post->ID);

        if (
            is_array($prog_level_edu) &&
            isset($prog_level_edu['prog_level_edu_2']) &&
            $prog_level_edu['prog_level_edu_2'] === 'Магистратура'
        ) {
            $bachelor_programs[] = $program_post;
        }
    }
    
    if (!empty($bachelor_programs)) {
        $area->bachelor_programs = $bachelor_programs;
        $filtered_areas[] = $area;
    }
}

$areas = $filtered_areas;

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