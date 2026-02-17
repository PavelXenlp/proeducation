<main>
    <div class="mainReviews">
        <div class="text-mainReviews">
            <h1><?php echo $page_title; ?></h1>
            <div class="links">
                <?php if ($twoGis = get_company_2gis()): ?>
                    <a href="<?php echo esc_attr($twoGis); ?>" target="_blank" class="linrs-mainReviews"><img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/2gis_icon.png"></a>
                <?php endif; ?>
                <?php if ($yaMap = get_company_yaMap()): ?>
                    <a href="<?php echo esc_attr($yaMap); ?>" target="_blank" class="linrs-mainReviews"><img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/ya_maps_icon.png"></a>
                <?php endif; ?>
            </div>
        </div>
        <?php
        $reviews = get_posts(array(
            'post_type' => 'reviews',
            'numberposts' => 6,
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ));
        if ($reviews):
        ?>
            <div class="allReviewsBlock">
                <?php
                foreach ($reviews as $review):
                ?>
                    <div class="block-reviews">
                        <div class="review-title">
                            <div class="text">
                                <h3><?php echo esc_html($review->post_title); ?></h3>
                                <p class="date">
                                    <?php echo get_field('job', $review->ID); ?>
                                </p>
                            </div>
                            <div class="star">
                                <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/stars.svg">
                            </div>
                        </div>
                        <div class="text-reviews">
                            <p><?php echo apply_filters('the_content', $review->post_content); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>