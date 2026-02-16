<?php
wp_head();
get_header();
?>
<div class="pageMargin"></div>
<div class="newsPageContainer">
    <div class="newsPageContent">
        <?php if (have_posts()) : while (have_posts()) : the_post(); 
            $current_post_id = get_the_ID(); // Сохраняем ID текущего поста
        ?>
                <article id="post-<?php echo $current_post_id; ?>" <?php post_class(); ?>>
                    <?php if (has_post_thumbnail()): ?>
                        <div class="newsPageContent_image">
                            <?php echo get_the_post_thumbnail($current_post_id, 'full'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="newsPageContent_content">
                        <h1><?php the_title(); ?></h1>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </article>
        <?php endwhile;
        endif; ?>
    </div>
    
    <div class="newsPageRecomends">
        <?php
        $recomended_args = array(
            'category_name' => 'news',
            'posts_per_page' => 5,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'post__not_in' => array($current_post_id)
        );
        
        $recomended_query = new WP_Query($recomended_args);
        
        if ($recomended_query->have_posts()) :
            while ($recomended_query->have_posts()) : $recomended_query->the_post(); ?>
                <a class="newsPageRecomends_item" href="<?php the_permalink(); ?>">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                    <div class="newsPageRecomends_itemRow">
                        <div class="more">Подробнее</div>
                        <div class="date"><?php echo get_the_date('d.m.Y'); ?></div>
                    </div>
                </a>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Нет других новостей</p>
        <?php endif; ?>
    </div>
</div>
</main>

<?php
get_footer();
wp_footer();
?>