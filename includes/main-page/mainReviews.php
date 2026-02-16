<div class="mainReviews">
    <div class="text-mainReviews">
        <h2>Отзывы наших клиентов</h2>
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
    <div class="swiper-reviews">
        <div class="swiper mainReviews-reviews-swiper">
            <div class="swiper-wrapper">
                <?php
                foreach ($reviews as $review):
                ?>
                <div class="swiper-slide">
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
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="swiper-btn">
            <a href="/clients/proeducation/reviews" class="link border">
                <span>Посмотреть все отзывы</span>
                <span>
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#FF644D"></circle>
                        <path d="M10 20L20 10M20 10H10M20 10V20" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </span>
            </a>
            <div class="btn-swiper">
                <button class="btn-left"><img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/left.svg"></button>
                <button class="btn-rigth"><img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/right.svg"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>