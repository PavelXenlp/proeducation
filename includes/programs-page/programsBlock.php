<?php
$tabs = [
    'Все направления',
    'Колледж',
    'Бакалавриат',
    'Магистратура',
    'С аттестатом 9 классов',
    'С аттестатом 11 классов + ЕГЭ',
    'С дипломом ВУЗа',
    'С аттестатом 11 классов без ЕГЭ',
    'С дипломом СПО: колледж, техникум'
];
?>
<main>
    <div class="programsBlock">
        <div class="mainDirectionsSearchContainer">
            <div class="mainBannerFormContentSearch">
                <span class="searchIcon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#006499" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M20.9999 21.0004L16.6499 16.6504" stroke="#006499" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                <input type="text" name="search" placeholder="Введите название направления или специальность ">
            </div>
        </div>
        <div class="mainDirectionsSearchTabs">
            <?php foreach ($tabs as $key => $tab): ?>
                <div class="mainDirectionsSearchTabItem <?php if ($key == 0): ?>active<?php endif; ?>"><?= $tab ?></div>
            <?php endforeach; ?>
        </div>
        <?php if ($areas): ?>
            <div class="programsBlockList">
                <?php foreach ($areas as $key => $area): ?>
                    <div class="programsBlockItem">
                        <div class="programsBlockItemTitle">
                            <h2><?php echo esc_html($area->post_title); ?></h2>
                            <a href="<?php echo get_permalink($area->ID); ?>" class="link border">
                                <span>Подробнее о программе</span>
                                <span>
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="15" cy="15" r="15" fill="#FF644D"></circle>
                                        <path d="M10 20L20 10M20 10H10M20 10V20" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                        <div class="programsBlockItem_programsTable <?php if ($key % 2 == 0) {
                                                                        echo 'tableKey_even';
                                                                    } ?>">
                            <div class="programsBlockItem_programsTableHeader">
                                <div class="col-1">Уровень образования</div>
                                <div class="col-2">
                                    <div>Направление подготовки</div>
                                    <div>Наименование образовательной программы</div>
                                </div>
                            </div>
                            <?php
                            if (property_exists($area, 'bachelor_programs')) {
                                $related_programs = $area->bachelor_programs;
                            } else {
                                $related_programs = get_field('programs', $area->ID);
                            }
                            $levels_edu_programs = get_field('level_edu', $area->ID);
                            foreach ($levels_edu_programs as $level_edu_program):
                                foreach ($related_programs as $program_post):
                                    $prog_level_edu = get_field('prog_level_edu', $program_post->ID);
                                    if ($level_edu_program == $prog_level_edu['prog_level_edu_2']):
                            ?>
                                        <div class="programsBlockItem_programItem">
                                            <div class="programsBlockItem_programEduLevel">
                                                <h3><?= $level_edu_program; ?></h3>
                                                <p>
                                                    <?php
                                                    if ($level_edu_program == 'Колледж') {
                                                        echo '2 года 10 мес.';
                                                    } elseif ($level_edu_program == 'Бакалавриат') {
                                                        echo '3,5 года';
                                                    } elseif ($level_edu_program == 'Магистратура') {
                                                        echo '2,5 года';
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="programsBlockItem_direction">
                                                <?php
                                                foreach ($prog_level_edu['direction_training'] as $direction):
                                                ?>
                                                    <div class="programsBlockItem_directionItem">
                                                        <div class="programsBlockItem_directionItemTitle"><?php echo esc_html($direction->post_title); ?></div>
                                                        <div class="programsBlockItem_directionItemContent"><?php echo apply_filters('the_content', $direction->post_content); ?></div>
                                                    </div>
                                                <?php
                                                endforeach;
                                                ?>
                                            </div>
                                        </div>
                            <?php
                                    endif;
                                endforeach;
                            endforeach;
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>