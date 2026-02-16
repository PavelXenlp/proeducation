<main>
    <div class="mainCompanies">
        <div class="titleBlock center">
            <h2>Компании, где работают наши выпускники</h2>
        </div>
        <?php
        $companies = get_posts(array(
            'post_type' => 'companies',
            'numberposts' => -1,
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ));
        if ($companies):
        ?>
            <div class="mainCompaniesGrid">
                <?php
                foreach ($companies as $company):
                ?>
                    <div class="mainCompaniesGridItem">
                        <?php if (has_post_thumbnail($company->ID)): ?>
                            <?php echo get_the_post_thumbnail($company->ID, 'medium', array(
                                'alt' => get_the_title($company->ID)
                            )); ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
    </div>
<?php endif; ?>
</main>