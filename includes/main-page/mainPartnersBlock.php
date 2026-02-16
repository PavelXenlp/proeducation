<div class="mainPartnersBlock">
    <h2>Партнеры PRO-образование</h2>
    <?php
    $partners = get_posts(array(
        'post_type' => 'partners',
        'numberposts' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));
    if ($partners):
    ?>
        <div class="swiper block-mainPartnersBlock">
            <div class="swiper-wrapper">
                <?php
                foreach ($partners as $partner):
                ?>
                    <div class="swiper-slide block">
                        <?php if (has_post_thumbnail($partner->ID)): ?>
                            <?php echo get_the_post_thumbnail($partner->ID, 'medium', array(
                                'alt' => get_the_title($partner->ID),
                                'class' => 'partner-logo'
                            )); ?>
                        <?php else: ?>
                            <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/logo-placeholder.png"
                                alt="<?php echo esc_attr(get_the_title($partner->ID)); ?>">
                        <?php endif; ?>
                        <div class="text">
                            <a href="<?php echo get_field('partner_cert_link', $partner->ID); ?>" target="_blank"><img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/doc-icon.svg" alt="File Icon">Лицензия</a>
                            <a href="<?php echo get_field('partner_accreditation_link', $partner->ID); ?>" target="_blank"><img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/doc-icon.svg" alt="File Icon">Аккредитация</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>