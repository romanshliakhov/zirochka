<?php
get_header();
?>


    <section class="search-section" >
        <div class="container">
            <div class="search-section__box">
                <div class="search-section__top">
                    <h1 class="h1"><?= __('Знайдено за запитом', 'zirochka') ?>: Історія</h1>

                    <span class="search-section__info">
                        <i class="sprite"><?php sprite(16, 16, 'article') ?></i>
                        14 <?= __('статей', 'zirochka') ?>
                    </span>
                </div>

<!--                TODO-->
<!--                тут или редактор если пусто или список карточек -->
                <div class="editor">
                    <?php sprite(248, 240, 'star_search'); ?>
                    <p class="h2">За цим запитом — порожнеча. Архів мовчить, ідей не відгукнулося</p>
                    <p>Спробуйте змінити формулювання</p>
                </div>

            </div>
        </div>
    </section>

<?php
get_footer();

