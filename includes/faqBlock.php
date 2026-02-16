<main>
    <div class="faqBlock">
        <div class="heading-faqBlock">
            <h2>Частые вопросы наших абитуриентов</h2>
            <a href="/clients/proeducation/faq" class="link noBorder">
                <span>Посмотреть все ответы</span>
                <span>
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#FF644D"></circle>
                        <path d="M10 20L20 10M20 10H10M20 10V20" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </span>
            </a>
        </div>
        <div class="faqBlock-questions">
            <?php
            $faqs = get_posts(array(
                'post_type' => 'faq',
                'numberposts' => 6,
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));

            if ($faqs):
                // Разбиваем на блоки по 3 вопроса
                $chunks = array_chunk($faqs, 3);
                foreach ($chunks as $key_ch => $chunk):
            ?>
                    <div class="block">
                        <?php foreach ($chunk as $key => $faq): ?>
                            <div class="question <?php if ($key == 0 && $key_ch == 0) {
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
                        <?php endforeach; ?>
                    </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
        <a href="/clients/proeducation/faq" class="link border mobileBtn">
            <span>Посмотреть все ответы</span>
            <span>
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="15" cy="15" r="15" fill="#FF644D"></circle>
                    <path d="M10 20L20 10M20 10H10M20 10V20" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                </svg>
            </span>
        </a>
    </div>
</main>