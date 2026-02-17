<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sal.js@0.8.5/dist/sal.css">
</head>

<?php

$header_menu = [
    [
        'name' => 'Программы',
        'link' => '/clients/proeducation/programs'
    ],
    [
        'name' => 'Бакалавриат',
        'link' => '/clients/proeducation/bakalavriat'
    ],
    [
        'name' => 'Магистратура',
        'link' => '/clients/proeducation/magistratura'
    ],
    [
        'name' => 'Колледж',
        'link' => '/clients/proeducation/kolledzh'
    ],
    [
        'name' => 'О нас',
        'link' => '/clients/proeducation/about-us/'
    ],
    [
        'name' => 'Блог',
        'link' => '/clients/proeducation/news/'
    ],
    [
        'name' => 'Отзывы',
        'link' => '/clients/proeducation/reviews'
    ],
    [
        'name' => 'Контакты',
        'link' => '/clients/proeducation/contacts'
    ]
];

?>

<body>
    <header>
        <div class="header-container">
            <a href="/clients/proeducation" class="logo">
                <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/logo-header.png" alt="">
            </a>
            <div class="header-rigth">
                <div class="header-contacts">
                    <?php if ($phone = get_company_phone()): ?>
                        <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                    <?php endif; ?>
                    <?php if ($email = get_company_email()): ?>
                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                    <?php endif; ?>
                </div>
                <div class="header-socials">
                    <?php if ($telegram = get_company_telegram()): ?>
                        <a href="<?php echo esc_url($telegram); ?>">
                            <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/tg-header.svg" alt="">
                        </a>
                    <?php endif; ?>
                    <?php if ($vk = get_company_vk()): ?>
                        <a href="<?php echo esc_url($vk); ?>">
                            <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/vk-header.svg" alt="">
                        </a>
                    <?php endif; ?>
                </div>
                <div class="btnRequestHeader">Получить консультацию</div>
            </div>
            <div class="headerBurgerIcon">
                <svg width="30" height="23" viewBox="0 0 30 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.5 1.5H28.5M1.5 11.5H28.5M16.6875 21.5H28.5" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
        <div class="header-menu">
            <?php foreach ($header_menu as $item): ?>
                <a href="<?= $item['link'] ?>"><?= $item['name'] ?></a>
            <?php endforeach; ?>
        </div>
    </header>
    <div class="headerBurgerMenu">
        <div class="headerBurgerMenu_close">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.8332 4.16602L4.1665 15.8327" stroke="#006499" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15.8332 15.8327L4.1665 4.16602" stroke="#006499" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="headerBurgerMenu_logo">
            <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/logo-header.png" alt="">
        </div>
        <div class="headerBurgerMenu_list">
            <?php foreach ($header_menu as $item): ?>
                <a href="<?= $item['link'] ?>"><?= $item['name'] ?></a>
            <?php endforeach; ?>
        </div>
        <div class="headerBurgerMenu_socials">
            <?php if ($telegram = get_company_telegram()): ?>
                <a href="<?php echo esc_url($telegram); ?>">
                    <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/tg-header.svg" alt="">
                </a>
            <?php endif; ?>
            <?php if ($vk = get_company_vk()): ?>
                <a href="<?php echo esc_url($vk); ?>">
                    <img src="/clients/proeducation/wp-content/themes/custom_theme/assets/img/vk-header.svg" alt="">
                </a>
            <?php endif; ?>
        </div>
        <div class="headerBurgerMenu_contacts">
            <?php if ($phone = get_company_phone()): ?>
                <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
            <?php endif; ?>
            <?php if ($email = get_company_email()): ?>
                <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
            <?php endif; ?>
        </div>
        <div class="btnRequestHeader">Получить консультацию</div>
    </div>
    <main>