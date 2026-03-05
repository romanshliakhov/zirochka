<?php
$shower = get_sub_field('shower');

if (!$shower) : ?>
    <section class="section-hero">

    </section>
<?php endif; ?>

<section class="cta-section mode">
    <div class="container">
        <div class="cta-section__box">
            <div class="cta-section__bg">
                <img width="248" height="240"
                     src="<?= esc_url(get_template_directory_uri() . '/assets/img/sprite/star.svg'); ?>"
                     loading="lazy"/>
            </div>

            <div class="editor">
                <p class="h2">Підписуйтесь на новини від Зірочка *</p>
                <p>Долучайтесь до спільноти, підтримуйте якісну україномовну журналістику</p>
            </div>
            <div class="editor">
                <button class="main-button">Підписатися</button>
            </div>
        </div>
    </div>
</section>

<section class="tags-section">
    <div class="container">
        <div class="tags-section__box">
            <div class="editor">
                <h2 class="h1">
                    <i class="sprite">
                        <?php sprite(29, 28, 'star_icon') ?>
                    </i>
                    Теги</h2>
            </div>

            <div class="tags-section__content">
                <ul class="tags-section__list">
                    <li>
                        <a href="#" class="tag">
                            # Геополітика (14)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Коментар (10)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Світ (2)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Місто (4)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Свідоме (25)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Екзистенціалізм (14)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Доступно спільноті (8)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Репортаж (11)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Інтервʼю (13)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Спецпроєкт (36)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Закритий матеріал (40)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Відібрані матеріали (16)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Регіональна аналітика (4)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Фінансове планування (7)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Геополітика (14)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Коментар (10)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Світ (2)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Місто (4)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Регіональна аналітика (4)
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tag">
                            # Фінансове планування (7)
                        </a>
                    </li>
                </ul>

                <button class="main-button main-button--transparent">Показати більше</button>
            </div>
        </div>
    </div>
</section>

<section class="selected-section">
    <div class="container">
        <div class="selected-section__box">
            <div class="editor">
                <h2 class="h1">
                    <i class="sprite">
                        <?php sprite(29, 28, 'star_icon') ?>
                    </i>
                    Відібрані матеріали</h2>
            </div>

            <div class="selected-section__inner">
                <a href="#" class="news-card">
                    <div class="news-card__image">
                        <img width="860" height="482"
                             src="<?= esc_url(get_template_directory_uri() . '/assets/img/img.png'); ?>"
                             loading="lazy"/>
                    </div>

                    <span class="tag"># Стаття тижня</span>

                    <div class="news-card__box">
                        <span class="h2">Невдала російська революція? Повстання декабристів 1825 року</span>
                        <p>У грудні 1825 року невелика група російських офіцерів розпочала невдале повстання, яке
                            радянська влада відзначила як Першу російську революцію.</p>

                        <div class="news-card__bottom">
                                <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'clock') ?>
                                    </i>
                                    3 хв
                                </span>
                            <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'calendar') ?>
                                    </i>
                                    15.01.26
                                </span>
                            <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'user') ?>
                                    </i>
                                    Василина Яременко
                                </span>
                        </div>
                    </div>
                </a>

                <ul class="selected-section__list">
                    <li class="selected-section__item">
                        <a href="#" class="news-card small">
                            <div class="news-card__image">
                                <img width="310" height="146"
                                     src="<?= esc_url(get_template_directory_uri() . '/assets/img/img2.png'); ?>"
                                     loading="lazy"/>
                            </div>

                            <span class="tag"># Історія</span>

                            <div class="news-card__box">
                                <span class="h3">Осман I, легендарний засновник Османської імперії</span>
                                <p>У грудні 1825 року невелика група російських офіцерів розпочала невдале повстання,
                                    яке радянська влада відзначила як Першу російську революцію.</p>
                                <div class="news-card__bottom">
                                <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'clock') ?>
                                    </i>
                                    3 хв
                                </span>
                                    <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'calendar') ?>
                                    </i>
                                    14.01.26
                                </span>
                                    <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'user') ?>
                                    </i>
                                  <span> Юлія Черевач</span>
                                </span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="selected-section__item">
                        <a href="#" class="news-card small">
                            <div class="news-card__image">
                                <img width="310" height="146"
                                     src="<?= esc_url(get_template_directory_uri() . '/assets/img/img3.png'); ?>"
                                     loading="lazy"/>
                            </div>

                            <span class="tag"># Філософія</span>

                            <div class="news-card__box">
                                <span class="h3">Архетип матері в теорії Карла Юнга</span>
                                <p>У грудні 1825 року невелика група російських офіцерів розпочала невдале повстання,
                                    яке радянська влада відзначила як Першу російську революцію.</p>

                                <div class="news-card__bottom">
                                <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'clock') ?>
                                    </i>
                                    2 хв
                                </span>
                                    <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'calendar') ?>
                                    </i>
                                    10.01.26
                                </span>
                                    <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'user') ?>
                                    </i>
                                    <span>Анна Деревʼянко</span>
                                </span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="selected-section__item">
                        <a  href="#" class="news-card small">
                            <div class="news-card__image">
                                <img width="310" height="146"
                                     src="<?= esc_url(get_template_directory_uri() . '/assets/img/img4.png'); ?>"
                                     loading="lazy"/>
                            </div>

                            <span class="tag"># Цікаве</span>

                            <div class="news-card__box">
                                <span class="h3">Маловідома кельтська королева Картімандуя, яка підтримувала римлян</span>
                                <p>У грудні 1825 року невелика група російських офіцерів розпочала невдале повстання,
                                    яке радянська влада відзначила як Першу російську революцію.</p>

                                <div class="news-card__bottom">
                                <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'clock') ?>
                                    </i>
                                    4 хв
                                </span>
                                    <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'calendar') ?>
                                    </i>
                                    28.12.26
                                </span>
                                    <span class="news-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'user') ?>
                                    </i>
                                 <span>  Анатолій Перепілко</span>
                                </span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="blog-section">
    <div class="container">
        <div class="blog-section__box">
            <div class="editor">
                <h2 class="h1">
                    <i class="sprite">
                        <?php sprite(29, 28, 'star_icon') ?>
                    </i>
                    Фід</h2>
            </div>

            <ul class="blog-list">
                <li class="blog-list__item">
                    <a href="#" class="blog-card">
                        <div class="blog-card__image">
                            <img width="860" height="482"
                                 src="<?= esc_url(get_template_directory_uri() . '/assets/img/img.png'); ?>"
                                 loading="lazy"/>
                        </div>

                        <span class="tag"># Цікаве</span>

                        <div class="blog-card__box">
                            <span class="h2">«На дотик усе тут як диван та пісок» — незрячі кияни про свої улюблені місця в столиці</span>
                            <p>Наша редакція попросила незрячих мешканців Києва розповісти про особливі для них місцини, а Євгенія Полосіна, не знаючи, про які саме локації йдеться, відобразила їх у ілюстраціях.</p>

                            <div class="blog-card__bottom">
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'clock') ?>
                                    </i>
                                  9 хв
                                </span>
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'calendar') ?>
                                    </i>
                                    16.01.26
                                </span>
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'user') ?>
                                    </i>
                                   <span> Антон Кравченко</span>
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="blog-list__item">
                    <a href="#" class="blog-card">
                        <div class="blog-card__image">
                            <img width="860" height="482"
                                 src="<?= esc_url(get_template_directory_uri() . '/assets/img/img.png'); ?>"
                                 loading="lazy"/>
                        </div>

                        <span class="tag"># Політика</span>

                        <div class="blog-card__box">
                            <span class="h2">Невдала російська революція? Повстання декабристів 1825 року</span>
                            <p>У грудні 1825 року невелика група російських офіцерів розпочала невдале повстання, яке радянська влада відзначила як Першу російську революцію.</p>

                            <div class="blog-card__bottom">
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'clock') ?>
                                    </i>
                                  3 хв
                                </span>
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'calendar') ?>
                                    </i>
                                    14.01.26
                                </span>
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'user') ?>
                                    </i>
                                <span>   Альбіна Мус</span>
                                </span>
                            </div>
                        </div>
                    </a>
                </li>

                <li class="blog-list__item mode">
                    <a href="#" class="blog-card">
                        <div class="blog-card__image">
                            <img width="860" height="482"
                                 src="<?= esc_url(get_template_directory_uri() . '/assets/img/img2.png'); ?>"
                                 loading="lazy"/>
                        </div>

                        <span class="tag"># Інтервʼю</span>

                        <div class="blog-card__box">
                            <span class="h2">Віталій Манський: «Мій фільм — для наступних поколінь українців»</span>
                            <p>В українських кінотеатрах стартували покази «Часу підльоту» — документального фільму Віталія Манського про ілюзорне мирне життя тилового Львова. </p>

                            <div class="blog-card__bottom">
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'clock') ?>
                                    </i>
                                  5 хв
                                </span>
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'calendar') ?>
                                    </i>
                                    03.01.26
                                </span>
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'user') ?>
                                    </i>
                                 <span> Марія Джеренашвілі</span>
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="blog-list__item mode">
                    <a href="#" class="blog-card">
                        <div class="blog-card__image">
                            <img width="860" height="482"
                                 src="<?= esc_url(get_template_directory_uri() . '/assets/img/img3.png'); ?>"
                                 loading="lazy"/>
                        </div>

                        <span class="tag"># Цікаве</span>

                        <div class="blog-card__box">
                            <span class="h2">Чому всі обговорюють «безсмертя» Бернара Арно?</span>
                            <p>Бернар Арно, 76-річний засновник імперії товарів люкс Louis Vuitton Moët Hennessy (LVMH), отримав статус «безсмертного» — довічного члена Академії моральних і політичних наук.</p>

                            <div class="blog-card__bottom">
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'clock') ?>
                                    </i>
                                  3 хв
                                </span>
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'calendar') ?>
                                    </i>
                                    28.12.25
                                </span>
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'user') ?>
                                    </i>
                               <span>   Юрій Теслюк</span>
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="blog-list__item mode">
                    <a href="#" class="blog-card">
                        <div class="blog-card__image">
                            <img width="860" height="482"
                                 src="<?= esc_url(get_template_directory_uri() . '/assets/img/img4.png'); ?>"
                                 loading="lazy"/>
                        </div>

                        <span class="tag"># Цікаве</span>

                        <div class="blog-card__box">
                            <span class="h2">Від Анаксімандра до Маркса, або Як я провів одну половину свого життя в «революційній» секті, а іншу — зʼясовуючи чому </span>
                            <p>Ця стаття є другою частиною міркувань британського троцькістського активіста та робітника Боба Маєрса про своє активістське минуле у Робітничій революційній партії.</p>

                            <div class="blog-card__bottom">
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'clock') ?>
                                    </i>
                                  4 хв
                                </span>
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'calendar') ?>
                                    </i>
                                    20.12.26
                                </span>
                                <span class="blog-card__info">
                                     <i class="sprite">
                                        <?php sprite(16, 16, 'user') ?>
                                    </i>
                                 <span>Віктор Федірко</span>
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="cta-section__bg">
        <img width="1920" height="153"
             src="<?= esc_url(get_template_directory_uri() . '/assets/img/sprite/star_bg.svg'); ?>"
             loading="lazy"/>

    </div>
    <div class="container">
        <div class="cta-section__box">
            <div class="editor">
                <p class="h2">Хочете розмістити свою статтю на Зірочка?</p>
                <p>Надсилайте її у форму і ми опублікуємо на сайті</p>
            </div>
            <div class="editor">
                <button class="main-button">Надіслати статтю</button>
            </div>
        </div>
    </div>
</section>