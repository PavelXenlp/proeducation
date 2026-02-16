<?php

/**
 * vem-maf.ru functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package csd23.ru
 * @since csd23.ru
 */

add_theme_support('post-thumbnails');
add_post_type_support('page', array('excerpt'));

function mytheme_enqueue_styles()
{
    wp_enqueue_style('style', get_stylesheet_uri()); // Подключает основной файл стилей style.css
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/style.css?v=' . time()); // Подключение дополнительного файла стилей
    wp_enqueue_style('amedia-custom-style', get_template_directory_uri() . '/assets/css/amedia.css?v=' . time()); // Подключение дополнительного файла стилей
    if (is_page_template('programs.php') || is_page_template('bachelor.php') || is_page_template('master.php') || is_page_template('college.php')) {
        wp_enqueue_style(
            'programs-page-style',
            get_template_directory_uri() . '/assets/css/templates/programs-page.css?v=' . time(),
            array(),
            '1.0.0'
        );
    }
    if (is_page_template('contacts.php')) {
        wp_enqueue_style(
            'contact-page-style', // Измените handle, если нужно отдельно
            get_template_directory_uri() . '/assets/css/templates/contact-page.css?v=' . time(),
            array(),
            '1.0.0'
        );
    }
    if (is_singular('areas')) {
        wp_enqueue_style(
            'program-page-style', // Измените handle, если нужно отдельно
            get_template_directory_uri() . '/assets/css/templates/program-page.css?v=' . time(),
            array(),
            '1.0.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');


/**
 * Автоматическая транслитерация кириллических URL (слагов) в латиницу
 * Преобразует название записи в латинские символы при сохранении/обновлении
 */
function transliterate_slug($title, $raw_title = '', $context = '')
{
    if ('save' !== $context) {
        return $title;
    }

    $translit_table = array(
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'yo',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'y',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'ts',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sch',
        'ъ' => '',
        'ы' => 'y',
        'ь' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',
        'А' => 'A',
        'Б' => 'B',
        'В' => 'V',
        'Г' => 'G',
        'Д' => 'D',
        'Е' => 'E',
        'Ё' => 'Yo',
        'Ж' => 'Zh',
        'З' => 'Z',
        'И' => 'I',
        'Й' => 'Y',
        'К' => 'K',
        'Л' => 'L',
        'М' => 'M',
        'Н' => 'N',
        'О' => 'O',
        'П' => 'P',
        'Р' => 'R',
        'С' => 'S',
        'Т' => 'T',
        'У' => 'U',
        'Ф' => 'F',
        'Х' => 'H',
        'Ц' => 'Ts',
        'Ч' => 'Ch',
        'Ш' => 'Sh',
        'Щ' => 'Sch',
        'Ъ' => '',
        'Ы' => 'Y',
        'Ь' => '',
        'Э' => 'E',
        'Ю' => 'Yu',
        'Я' => 'Ya',
    );

    $title = strtr($title, $translit_table);

    $title = preg_replace('/[^\x20-\x7E]/u', '-', $title);

    $title = preg_replace('/[^\w\p{L}\p{N}_-]/u', '-', $title);

    $title = preg_replace('/-+/', '-', $title);

    $title = trim($title, '-');

    $title = strtolower($title);

    if (empty($title)) {
        $title = 'post-' . date('Y-m-d-H-i-s');
    }

    return $title;
}
add_filter('sanitize_title', 'transliterate_slug', 9, 3);

add_action('wp_ajax_search_programs', 'search_programs_callback');
add_action('wp_ajax_nopriv_search_programs', 'search_programs_callback');

function search_programs_callback()
{
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'search_programs_nonce')) {
        wp_send_json_error('Ошибка безопасности');
    }

    $search_query = sanitize_text_field($_POST['search_query']);
    $active_tab = sanitize_text_field($_POST['active_tab']);

    $areas = get_posts(array(
        'post_type' => 'areas',
        'numberposts' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    $results = array();
    $total_count = 0;

    if ($areas) {
        foreach ($areas as $key => $area) {
            $area_data = array(
                'id' => $area->ID,
                'title' => esc_html($area->post_title),
                'permalink' => get_permalink($area->ID),
                'index' => $key,
                'is_even' => ($key % 2 == 0),
                'programs' => array(),
                'has_results' => false
            );

            if (property_exists($area, 'bachelor_programs')) {
                $related_programs = $area->bachelor_programs;
            } else {
                $related_programs = get_field('programs', $area->ID);
            }

            $levels_edu_programs = get_field('level_edu', $area->ID);

            foreach ($levels_edu_programs as $level_edu_program) {
                if (!filter_by_tab($level_edu_program, $active_tab)) {
                    continue;
                }

                foreach ($related_programs as $program_post) {
                    $prog_level_edu = get_field('prog_level_edu', $program_post->ID);

                    if ($level_edu_program == $prog_level_edu['prog_level_edu_2']) {

                        foreach ($prog_level_edu['direction_training'] as $direction) {
                            $direction_title = strtolower($direction->post_title);
                            $direction_content = strtolower(strip_tags($direction->post_content));
                            $area_title = strtolower($area->post_title);
                            $search_lower = strtolower($search_query);

                            if (
                                empty($search_query) ||
                                strpos($direction_title, $search_lower) !== false ||
                                strpos($direction_content, $search_lower) !== false ||
                                strpos($area_title, $search_lower) !== false
                            ) {

                                $area_data['has_results'] = true;
                                $total_count++;

                                $program_data = array(
                                    'level_edu' => esc_html($level_edu_program),
                                    'duration' => get_program_duration($level_edu_program),
                                    'direction_title' => esc_html($direction->post_title),
                                    'direction_content' => apply_filters('the_content', $direction->post_content),
                                    'direction_id' => $direction->ID
                                );

                                $area_data['programs'][] = $program_data;
                            }
                        }
                    }
                }
            }

            if ($area_data['has_results']) {
                $results[] = $area_data;
            }
        }
    }

    wp_send_json_success(array(
        'results' => $results,
        'total_count' => $total_count,
        'search_query' => $search_query,
        'active_tab' => $active_tab
    ));
}

function filter_by_tab($level_edu, $active_tab)
{
    if ($active_tab == 'Все направления' || empty($active_tab)) {
        return true;
    }

    $tab_mapping = array(
        'Колледж' => ['Колледж'],
        'Бакалавриат' => ['Бакалавриат'],
        'Магистратура' => ['Магистратура'],
        'С аттестатом 9 классов' => ['Колледж'],
        'С аттестатом 11 классов + ЕГЭ' => ['Бакалавриат'],
        'С дипломом ВУЗа' => ['Магистратура'],
        'С аттестатом 11 классов без ЕГЭ' => ['Колледж'],
        'С дипломом СПО: колледж, техникум' => ['Бакалавриат']
    );

    return isset($tab_mapping[$active_tab]) && in_array($level_edu, $tab_mapping[$active_tab]);
}

function get_program_duration($level_edu)
{
    switch ($level_edu) {
        case 'Колледж':
            return '2 года 10 мес.';
        case 'Бакалавриат':
            return '3,5 года';
        case 'Магистратура':
            return '2,5 года';
        default:
            return '';
    }
}

add_action('wp_enqueue_scripts', 'enqueue_search_programs_script');

function enqueue_search_programs_script()
{
    wp_enqueue_script('search-programs', get_template_directory_uri() . '/assets/js/search-programs.js', array('jquery'), '1.0', true);

    wp_localize_script('search-programs', 'search_programs_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('search_programs_nonce')
    ));
}

add_action('admin_menu', 'add_company_settings_page');

function add_company_settings_page()
{
    add_options_page(
        'Настройки компании',
        'Настройки компании',
        'manage_options',
        'company-settings',
        'render_company_settings_page'
    );
}

function render_company_settings_page()
{
?>
    <div class="wrap">
        <h1>Настройки компании</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('company_settings_group');
            do_settings_sections('company-settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

add_action('admin_init', 'register_company_settings');

function register_company_settings()
{
    register_setting('company_settings_group', 'company_phone');
    register_setting('company_settings_group', 'company_email');
    register_setting('company_settings_group', 'company_address');
    register_setting('company_settings_group', 'company_telegram');
    register_setting('company_settings_group', 'company_vk');
    register_setting('company_settings_group', 'company_facebook');
    register_setting('company_settings_group', 'company_working_hours');
    register_setting('company_settings_group', 'company_inn');
    register_setting('company_settings_group', 'company_legal_name');
    register_setting('company_settings_group', 'company_name');
    register_setting('company_settings_group', 'company_2gis');
    register_setting('company_settings_group', 'company_yaMap');

    add_settings_section(
        'company_main_section',
        'Основные настройки компании',
        null,
        'company-settings'
    );


    add_settings_field(
        'company_name_field',
        'Название компании',
        'render_company_name_field',
        'company-settings',
        'company_main_section'
    );

    add_settings_field(
        'company_2gis_field',
        'Ссылка на 2GIS',
        'render_company_2gis_field',
        'company-settings',
        'company_main_section'
    );

    add_settings_field(
        'company_yaMap_field',
        'Ссылка на яндекс карты',
        'render_company_yaMap_field',
        'company-settings',
        'company_main_section'
    );

    add_settings_field(
        'company_phone_field',
        'Телефон',
        'render_company_phone_field',
        'company-settings',
        'company_main_section'
    );

    add_settings_field(
        'company_email_field',
        'Email компании',
        'render_company_email_field',
        'company-settings',
        'company_main_section'
    );

    add_settings_field(
        'company_address_field',
        'Адрес',
        'render_company_address_field',
        'company-settings',
        'company_main_section'
    );

    add_settings_field(
        'company_working_hours_field',
        'Режим работы',
        'render_company_working_hours_field',
        'company-settings',
        'company_main_section'
    );

    add_settings_field(
        'company_inn_field',
        'ИНН',
        'render_company_inn_field',
        'company-settings',
        'company_main_section'
    );

    add_settings_field(
        'company_legal_name_field',
        'Юридическое название',
        'render_company_legal_name_field',
        'company-settings',
        'company_main_section'
    );

    add_settings_section(
        'company_social_section',
        'Социальные сети',
        'render_social_section_description',
        'company-settings'
    );

    add_settings_field(
        'company_telegram_field',
        'Telegram',
        'render_company_telegram_field',
        'company-settings',
        'company_social_section'
    );

    add_settings_field(
        'company_vk_field',
        'ВКонтакте',
        'render_company_vk_field',
        'company-settings',
        'company_social_section'
    );

    add_settings_field(
        'company_facebook_field',
        'Facebook',
        'render_company_facebook_field',
        'company-settings',
        'company_social_section'
    );
}

function render_company_name_field()
{
    $value = get_option('company_name', '');
    echo '<input type="text" name="company_name" value="' . esc_attr($value) . '" class="regular-text" placeholder="Введите название компании">';
}

function render_company_2gis_field()
{
    $value = get_option('company_2gis', '');
    echo '<input type="text" name="company_2gis" value="' . esc_attr($value) . '" class="regular-text" placeholder="Введите ссылка на 2gis">';
}

function render_company_yaMap_field()
{
    $value = get_option('company_yaMap', '');
    echo '<input type="text" name="company_yaMap" value="' . esc_attr($value) . '" class="regular-text" placeholder="Введите ссылка на Яндекс Карты">';
}

function render_company_phone_field()
{
    $value = get_option('company_phone', '');
    echo '<input type="tel" name="company_phone" value="' . esc_attr($value) . '" class="regular-text" placeholder="+7 (999) 123-45-67">';
}

function render_company_email_field()
{
    $value = get_option('company_email', '');
    echo '<input type="email" name="company_email" value="' . esc_attr($value) . '" class="regular-text" placeholder="info@example.com">';
}

function render_company_address_field()
{
    $value = get_option('company_address', '');
    echo '<input type="text" name="company_address" value="' . esc_attr($value) . '" class="regular-text" placeholder="г. Москва, ул. Примерная, д. 1">';
}

function render_company_working_hours_field()
{
    $value = get_option('company_working_hours', '');
    wp_editor($value, 'company_working_hours', array(
        'textarea_name' => 'company_working_hours',
        'textarea_rows' => 5,
        'media_buttons' => false,
        'teeny' => true,
        'quicktags' => true
    ));
}

function render_company_inn_field()
{
    $value = get_option('company_inn', '');
    echo '<input type="text" name="company_inn" value="' . esc_attr($value) . '" class="regular-text" placeholder="7701123456">';
}

function render_company_legal_name_field()
{
    $value = get_option('company_legal_name', '');
    echo '<input type="text" name="company_legal_name" value="' . esc_attr($value) . '" class="regular-text" placeholder="ООО «Ромашка»">';
}

function render_company_telegram_field()
{
    $value = get_option('company_telegram', '');
    echo '<input type="url" name="company_telegram" value="' . esc_attr($value) . '" class="regular-text" placeholder="https://t.me/username">';
}

function render_company_vk_field()
{
    $value = get_option('company_vk', '');
    echo '<input type="url" name="company_vk" value="' . esc_attr($value) . '" class="regular-text" placeholder="https://vk.com/username">';
}

function render_company_facebook_field()
{
    $value = get_option('company_facebook', '');
    echo '<input type="url" name="company_facebook" value="' . esc_attr($value) . '" class="regular-text" placeholder="https://facebook.com/username">';
}

function render_social_section_description()
{
    echo '<p>Введите полные URL ссылок на ваши страницы в социальных сетях</p>';
}

function get_company_phone()
{
    return get_option('company_phone', '');
}

function get_company_email()
{
    return get_option('company_email', '');
}

function get_company_address()
{
    return get_option('company_address', '');
}

function get_company_telegram()
{
    return get_option('company_telegram', '');
}

function get_company_vk()
{
    return get_option('company_vk', '');
}

function get_company_facebook()
{
    return get_option('company_facebook', '');
}

function get_company_working_hours()
{
    $hours = get_option('company_working_hours', '');
    return apply_filters('the_content', $hours);
}

function get_company_inn()
{
    return get_option('company_inn', '');
}

function get_company_legal_name()
{
    return get_option('company_legal_name', '');
}

function get_company_name()
{
    return get_option('company_name', '');
}

function get_company_2gis()
{
    return get_option('company_2gis', '');
}

function get_company_yaMap()
{
    return get_option('company_yaMap', '');
}
?>