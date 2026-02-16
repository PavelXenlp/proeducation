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
                            <li><a href="/clients/proeducation">Статьи</a></li>
                            <li><a href="/clients/proeducation/about-us/">О нас</a></li>
                            <li><a href="/clients/proeducation/reviews">Отзывы</a></li>
                            <li><a href="/clients/proeducation/contacts">Контакты</a></li>
                        </ul>
                    </nav>
                </div>

                <!--Блок второй-->
                <div class="footer-block-2">

                    <div class="block">
                        <p class="text-1">
                            г. Пермь,<br>
                            ул. Сибирская 35д
                        </p>
                        <p class="text-1">
                            Режим работы:<br>
                            ПН-ПТ: 09:00-18:00<br>
                            СБ,ВС: выходной
                        </p>
                    </div>

                    <div class="block1">
                        <p class="text2">ИНН: 5904387110</p>
                        <p class="text2">ООО "Камгород старт"</p>
                        <a href="#" class="link">Обработка персональных данных</a>
                        <a href="#" class="link">Политика конфиденциальности</a>
                    </div>

                    <div class="block2">
                        <div class="block">
                            <p class="text3">Телефон:</p>
                            <h2>8 (999) 364-99-21</h2>
                        </div>
                        <div class="block">
                            <p class="text3">Email:</p>
                            <h2>pro-obrazovanie.priem@yandex.ru</h2>
                        </div>

                    </div>

                    <div class="block3">
                        <div class="img-footer">
                            <a href="#"><img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/tg-header.svg" alt=""></a>
                            <a href="#"><img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/vk-header.svg" alt=""></a>
                        </div>
                        <p class="text4">@2026 PRO-образование</p>
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