<?php
$tabs = [
    [
        'name' => 'Все направления',
        'type' => 0
    ],
    [
        'name' => 'Колледж',
        'type' => 1
    ],
    [
        'name' => 'Бакалавриат',
        'type' => 2
    ],
    [
        'name' => 'Магистратура',
        'type' => 3
    ],
    [
        'name' => 'С аттестатом 9 классов',
        'type' => 1
    ],
    [
        'name' => 'С аттестатом 11 классов + ЕГЭ',
        'type' => 2
    ],
    [
        'name' => 'С дипломом ВУЗа',
        'type' => 3
    ],
    [
        'name' => 'С аттестатом 11 классов без ЕГЭ',
        'type' => 1
    ],
    [
        'name' => 'С дипломом СПО: колледж, техникум',
        'type' => 2
    ]
];
?>
<main>
    <div class="mainDirectionsBlock">
        <div class="titleBlock center">
            <h2>Выберите подходящее направление</h2>
            <p>Выберите направление, которое вас интересует и оставьте заявку! Специалист приёмной комиссии отправит вам учебный план и даст подробную консультацию!</p>
        </div>
        <div class="mainDirectionsSearchTabs">
            <?php foreach ($tabs as $key => $tab): ?>
                <div data-type="<?= $tab['type'] ?>" class="mainDirectionsSearchTabItem <?php if ($key == 0): ?>active<?php endif; ?>"><?= $tab['name'] ?></div>
            <?php endforeach; ?>
        </div>
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
        <div class="mainDirectionsGrid">
            <!-- Левая колонка -->
            <div class="mainDirectionsGridColumn">
                <?php foreach ($areas as $key => $area): ?>
                    <?php if ($key % 2 == 0): // Четные индексы (0, 2, 4...) - левая колонка ?>
                    <div class="mainDirectionsGridItem">
                        <h3><?php echo esc_html($area->post_title); ?></h3>
                        <p><?php echo get_the_excerpt($area->ID); ?></p>
                        <div class="mainDirectionsGridItemInfo">
                            <div class="mainDirectionsGridItemEdu">
                                <?php if(in_array('Колледж', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>Колледж</span>
                                </div>
                                <?php endif; ?>
                                <?php if(in_array('Бакалавриат', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>Бакалавриат</span>
                                </div>
                                <?php endif; ?>
                                <?php if(in_array('Магистратура', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>Магистратура</span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="mainDirectionsGridItemEdu">
                                <?php if(in_array('Колледж', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>от 2 лет 10 месяцев</span>
                                </div>
                                <?php endif; ?>
                                <?php if(in_array('Бакалавриат', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>от 3,5 лет</span>
                                </div>
                                <?php endif; ?>
                                <?php if(in_array('Магистратура', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>2,5 года</span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <a href="<?php echo get_permalink($area->ID); ?>" class="mainDirectionsGridItemLink">Смотреть программы</a>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            
            <!-- Правая колонка -->
            <div class="mainDirectionsGridColumn">
                <?php foreach ($areas as $key => $area): ?>
                    <?php if ($key % 2 != 0): // Нечетные индексы (1, 3, 5...) - правая колонка ?>
                    <div class="mainDirectionsGridItem">
                        <h3><?php echo esc_html($area->post_title); ?></h3>
                        <p><?php echo get_the_excerpt($area->ID); ?></p>
                        <div class="mainDirectionsGridItemInfo">
                            <div class="mainDirectionsGridItemEdu">
                                <?php if(in_array('Колледж', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>Колледж</span>
                                </div>
                                <?php endif; ?>
                                <?php if(in_array('Бакалавриат', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>Бакалавриат</span>
                                </div>
                                <?php endif; ?>
                                <?php if(in_array('Магистратура', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>Магистратура</span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="mainDirectionsGridItemEdu">
                                <?php if(in_array('Колледж', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>от 2 лет 10 месяцев</span>
                                </div>
                                <?php endif; ?>
                                <?php if(in_array('Бакалавриат', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>от 3,5 лет</span>
                                </div>
                                <?php endif; ?>
                                <?php if(in_array('Магистратура', get_field('level_edu', $area->ID))): ?>
                                <div class="mainDirectionsGridItemInfoItem">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" fill="#006499" />
                                        </svg>
                                    </span>
                                    <span>2,5 года</span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <a href="<?php echo get_permalink($area->ID); ?>" class="mainDirectionsGridItemLink">Смотреть программы</a>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</main>