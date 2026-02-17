<main>
    <div class="newsList">
        <h1><?php echo $page_title; ?></h1>
        <p><?php echo $page_excerpt; ?></p>

        <?php
        $args = array(
            'category_name' => 'news',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $news_query = new WP_Query($args);

        $with_image = [];
        $without_image = [];

        if ($news_query->have_posts()) {
            while ($news_query->have_posts()) {
                $news_query->the_post();
                if (has_post_thumbnail()) {
                    $with_image[] = get_post();
                } else {
                    $without_image[] = get_post();
                }
            }
            wp_reset_postdata();
        }
        ?>

        <div class="mainNewsCols">
            <?php
            $chunks = [];
            $with_image_chunks = array_chunk($with_image, 2);
            $without_image_chunks = array_chunk($without_image, 4);

            $max_chunks = max(count($with_image_chunks), count($without_image_chunks));

            for ($i = 0; $i < $max_chunks; $i++) {
                $chunks[] = [
                    'with_image' => isset($with_image_chunks[$i]) ? $with_image_chunks[$i] : [],
                    'without_image' => isset($without_image_chunks[$i]) ? $without_image_chunks[$i] : []
                ];
            }

            foreach ($chunks as $chunk_index => $chunk):
            ?>
                <?php if (!empty($chunk['with_image']) || !empty($chunk['without_image'])): ?>
                    <?php if (!empty($chunk['with_image'])): ?>
                        <div class="mainNewsColMain">
                            <?php foreach ($chunk['with_image'] as $post): ?>
                                <?php setup_postdata($post); ?>
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="mainNewsColMainItem  <?php if(count($chunk['with_image']) == 1){echo 'h-full';}?>">
                                    <div class="image">
                                        <?php echo get_the_post_thumbnail($post->ID, 'full', ['alt' => esc_attr(get_the_title($post->ID))]); ?>
                                    </div>
                                    <div class="content">
                                        <h3><?php echo esc_html($post->post_title); ?></h3>
                                        <p><?php echo wp_trim_words($post->post_content, 20, '...'); ?></p>
                                        <div class="mainNewsColMainItem_row">
                                            <div class="date"><?php echo get_the_date('d.m.Y', $post->ID); ?></div>
                                            <div class="newsLink">Подробнее</div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($chunk['without_image'])): ?>
                        <div class="mainNewsColSecond">
                            <?php foreach ($chunk['without_image'] as $post): ?>
                                <?php setup_postdata($post); ?>
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="mainNewsColSecondItem">
                                    <h3><?php echo esc_html($post->post_title); ?></h3>
                                    <p><?php echo wp_trim_words($post->post_content, 20, '...'); ?></p>
                                    <div class="mainNewsColSecondItem_row">
                                        <div class="date"><?php echo get_the_date('d.m.Y', $post->ID); ?></div>
                                        <div class="newsLink">Подробнее</div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</main>