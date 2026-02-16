<main class="it-2">
    <!--Кнопки переключение-->
    <div class="block-it-2">
        <h2>Выберите уровень образования</h2>

        <div class="nav-programs">
            <button class="main-2-btn-prog-college active" data-level="all">Все направления</button>
            <button class="main-2-btn-prog-bachelor" data-level="college">Колледж</button>
            <button class="main-2-btn-prog-magistr" data-level="bachelor">Бакалавриат</button>
            <button class="main-2-btn-prog-magistr" data-level="master">Магистратура</button>
        </div>
    </div>
    <?php
    $related_programs = get_field('programs', $page_id);
    if(!empty($related_programs)):
        foreach($related_programs as $related_program):
        $prog_level_edu = get_field('prog_level_edu', $related_program->ID);
    ?>
        <div class="block-it-3 level-college">

            <div class="programs">
                <div class="text">
                    <div>
                        <p>Уровень образования</p>
                    </div>
                    <div>
                        <h3><?php echo $prog_level_edu['prog_level_edu_2']; ?></h3>
                    </div>
                </div>
                <div class="text">
                    <div>
                        <p>Срок обучения</p>
                    </div>
                    <div>
                        <h3>
                            <?php
                            if ($prog_level_edu['prog_level_edu_2'] == 'Колледж') {
                                echo '2 года 10 мес.';
                            } elseif ($prog_level_edu['prog_level_edu_2'] == 'Бакалавриат') {
                                echo '3,5 года';
                            } elseif ($prog_level_edu['prog_level_edu_2'] == 'Магистратура') {
                                echo '2,5 года';
                            }
                            ?>
                        </h3>
                    </div>
                </div>
            </div>


            <div class="inf">
                <?php foreach ($prog_level_edu['direction_training'] as $direction): ?>
                <div class="block">
                    <div class="text-header">
                        <p>Направление подготовки</p>
                        <p>Наименование образовательной программы</p>
                    </div>
                    <div class="block-text-inf">
                        <div class="text">
                            <h4><?php echo esc_html($direction->post_title); ?></h4>
                        </div>
                        <div class="text">
                            <?php echo apply_filters('the_content', $direction->post_content); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
        </div>
    <?php 
        endforeach;
    endif; 
    ?>
</main>