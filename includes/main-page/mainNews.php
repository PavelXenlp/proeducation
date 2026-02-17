<main>
    <div class="faqBlock">
        <div class="heading-faqBlock">
            <h2>Статьи и новости PRO Образования</h2>
            <a href="/clients/proeducation/news" class="link noBorder">
                <span>Все новости</span>
                <span>
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#FF644D"></circle>
                        <path d="M10 20L20 10M20 10H10M20 10V20" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </span>
            </a>
        </div>

        <?php
        $args = array(
            'category_name' => 'news',
            'posts_per_page' => 8,
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
                if (has_post_thumbnail() && count($with_image) < 2) {
                    $with_image[] = get_post();
                } elseif (count($without_image) < 4) {
                    $without_image[] = get_post();
                }
            }
            wp_reset_postdata();
        }
        ?>

        <div class="mainNewsCols">
            <?php if (!empty($with_image)): ?>
                <div class="mainNewsColMain">
                    <?php foreach ($with_image as $post): ?>
                        <?php setup_postdata($post); ?>
                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="mainNewsColMainItem">
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

            <?php if (!empty($without_image)): ?>
                <div class="mainNewsColSecond">
                    <?php foreach ($without_image as $post): ?>
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
        </div>
    </div>
</main>