        </main>
        <footer>
            <div class="footer">

                <!--Блок первый-->
                <div class="footer-block-1">
                    <a href="/clients/proeducation/" class="img-logo-footer">
                        <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/footer_logo.png">
                    </a>
                    <nav class="nav-footer">
                        <ul>
                            <li><a href="/clients/proeducation/programs">Программы</a></li>
                            <li><a href="/clients/proeducation/bakalavriat">Бакалавриат</a></li>
                            <li><a href="/clients/proeducation/magistratura">Магистратура</a></li>
                            <li><a href="/clients/proeducation/kolledzh">Колледж</a></li>
                            <li><a href="/clients/proeducation/news">Статьи</a></li>
                            <li><a href="/clients/proeducation/about-us/">О нас</a></li>
                            <li><a href="/clients/proeducation/reviews">Отзывы</a></li>
                            <li><a href="/clients/proeducation/contacts">Контакты</a></li>
                        </ul>
                    </nav>
                </div>

                <!--Блок второй-->
                <div class="footer-block-2">

                    <div class="block">
                        <?php if ($address  = get_company_address()): ?>
                        <p class="text-1">
                            <?php echo esc_html($address); ?>
                        </p>
                        <?php endif; ?>
                        <?php if ($working_hours = get_company_working_hours()): ?>
                        <p class="text-1">
                            <?php echo $working_hours; ?>
                        </p>
                        <?php endif; ?>
                    </div>

                    <div class="block1">
                        <?php if($inn = get_company_inn()): ?>
                        <p class="text2">ИНН: <?php echo esc_html($inn); ?></p>
                        <?php endif; ?>
                        <?php if($companyLegalName = get_company_legal_name()): ?>
                        <p class="text2"><?php echo esc_html($companyLegalName); ?></p>
                        <?php endif; ?>
                        <a href="#" class="link">Обработка персональных данных</a>
                        <a href="#" class="link">Политика конфиденциальности</a>
                    </div>

                    <div class="block2">
                        <?php if ($phone = get_company_phone()): ?>
                        <div class="block">
                            <p class="text3">Телефон:</p>
                            <h2><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></h2>
                        </div>
                        <?php endif; ?>
                        <?php if ($email = get_company_email()): ?>
                        <div class="block">
                            <p class="text3">Email:</p>
                            <h2><a href="tel:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></h2>
                        </div>
                        <?php endif; ?>

                    </div>

                    <div class="block3">
                        <div class="img-footer">
                            <?php if ($telegram = get_company_telegram()): ?>
                                <a href="<?php echo esc_url($telegram); ?>"><img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/tg-header.svg" alt=""></a>
                            <?php endif; ?>
                            <?php if ($vk = get_company_vk()): ?>
                                <a href="<?php echo esc_url($vk); ?>"><img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/vk-header.svg" alt=""></a>
                            <?php endif; ?>
                        </div>
                        <p class="text4">@<?php echo date('Y'); ?> <?php echo get_company_name(); ?></p>
                    </div>

                </div>
            </div>
        </footer>
        <div class="popupContainer requestFormPopup">
            <div class="popup">
                <div class="closePopup">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.8332 4.16602L4.1665 15.8327" stroke="#006499" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15.8332 15.8327L4.1665 4.16602" stroke="#006499" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="image">
                    <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/requestIcon.png" alt="">
                </div>
                <div class="popupTitle">
                    Заполните форму, что бы начать обучение
                </div>
                <p>С вами свяжется специалист приёмной комиссии, даст консультацию и ответит на любые вопросы!</p>
                <div class="popupForm">
                    <div class="inputRow">
                        <div class="inputContainer">
                            <label>Ваше имя</label>
                            <input placeholder="Имя" type="text" name="name" id="">
                        </div>
                        <div class="inputContainer">
                            <label>Ваш телефон</label>
                            <input placeholder="+7 (___) ___ - __ - __ " type="text" class="formattedPhone" name="phone" id="">
                        </div>
                    </div>
                    <div class="inputContainer">
                        <label>Email</label>
                        <input placeholder="example@mail.ru" type="email" name="email" id="">
                    </div>
                    <div class="inputContainer">
                        <label>Уровень образования</label>
                        <div class="formTabs">
                            <div class="formTabsItem active">Колледж</div>
                            <div class="formTabsItem">Бакалавриат</div>
                            <div class="formTabsItem">Магистратура</div>
                        </div>
                    </div>
                    <div class="inputContainer">
                        <label>Направление</label>
                        <div class="customSelectContainer">
                            <div class="customSelect">
                                <span class="optionSelected">Все направления</span>
                                <span class="arrow">
                                    <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.707 0.707031L7.70703 7.70703L0.707031 0.707032" stroke="#006499" stroke-width="2" />
                                    </svg>
                                </span>
                            </div>
                            <div class="customSelectList">
                                <div class="customSelectListItem active">Все направления</div>
                                <?php
                                $areas = get_posts(array(
                                    'post_type' => 'areas',
                                    'numberposts' => -1,
                                    'post_status' => 'publish',
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC'
                                ));
                                if ($areas):
                                ?>
                                    <?php foreach ($areas as $key => $area): ?>
                                        <div class="customSelectListItem"><?php echo esc_html($area->post_title); ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="popupForm_submitBtn">
                        Оставить заявку
                    </div>
                    <p class="popupForm_submitBtnText">
                        Отправляя данную форму вы соглашаетесь с <a href="">политикой конфиденциальности</a>
                    </p>
                </div>
            </div>
        </div>
        </body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sal.js@0.8.5/dist/sal.js"></script>
        <script src="/clients/proeducation//wp-content/themes/custom_theme/assets/js/script.js?v=<? echo time(); ?>"></script>
        <script src="/clients/proeducation//wp-content/themes/custom_theme/assets/js/formatted-phone.js?v=<? echo time(); ?>"></script>

        </html>