<main>
    <div class="faqBlock">
        <div class="faqBlock-questions allFaq">
            <?php
            $faqs = get_posts(array(
                'post_type' => 'faq',
                'numberposts' => -1,
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));

            if ($faqs):
                foreach ($faqs as $key => $faq):
            ?>
                    <div class="question <?php if ($key == 0) {
                                                echo 'active';
                                            } ?>">
                        <img class="question-block" src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/Icon Wrapper.svg">
                        <div class="block-2">
                            <div class="question-heading">
                                <h3><?php echo esc_html($faq->post_title); ?></h3>
                                <button>
                                    <?php if ($key == 0): ?>
                                        <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/Button.svg">
                                    <?php else: ?>
                                        <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/Button (1).svg">
                                    <?php endif; ?>
                                </button>
                            </div>
                            <div class="faq-answer">
                                <?php echo apply_filters('the_content', $faq->post_content); ?>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</main>