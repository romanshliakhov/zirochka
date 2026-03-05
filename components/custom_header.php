<?php
    $languages = apply_filters('wpml_active_languages', NULL, array('skip_missing' => 0));
    $header = get_field('header', 'header');
    $global_setting = get_field('global_contacts', 'settings');

//    if ($header) {
//        $logo = $header['logo'];
//        $header_socials = $header['header_contacts'];
//        $whatsapp_rent = $header_socials['whatsapp_rent'];
//        $whatsapp_sell = $header_socials['whatsapp_sell'];
//        $telegram_rent = $header_socials['telegram_rent'];
//        $telegram_sell = $header_socials['telegram_sell'];
//        $viber_rent = $header_socials['viber_rent'];
//        $viber_sell = $header_socials['viber_sell'];
//    }
//
//    if($global_setting) {
//        $tel_rent = $global_setting['tel_rent'];
//        $tel_sell = $global_setting['tel_sell'];
//        $worktime = $global_setting['worktime'];
//    }
?>

<header class="header fixed-block" role="banner" <?php if (get_field('header_footer_enabler', get_the_ID())) : ?> style="display:none;" <?php endif; ?>>
    <div class="container">
        <div class="header__box">
            <div class="header__top">
                <button class="burger">
                    <span class="burger__line"></span>
                </button>

                <a class="header__logo" href="<?php echo home_url(); ?>" aria-label="logo">
                    <?php sprite( 166, 54, 'logo' ) ?>
                </a>

                <div class="header__wrapp">
                    <ul class="langs">
                       <li>
                           <a href="#" class="active">UA</a>
                       </li>
                        <li>
                            <a href="#">UA-L</a>
                        </li>
                        <li>
                            <a href="#">ENG</a>
                        </li>
                    </ul>

                    <form class="search-form">
                        <button class="search-form__btn">
                            <?php sprite( 20, 20, 'search' ) ?>
                        </button>
                    </form>
                </div>
            </div>



            <div class="mobile">
                <div class="mobile__box" data-single='false' data-breakpoint='576' data-accordion>
                    <div class="mobile__top">
                        <button class="burger">
                            <span class="burger__line"></span>
                        </button>

                        <a class="header__logo" href="<?php echo home_url(); ?>" aria-label="logo">
                            <?php sprite( 166, 54, 'logo' ) ?>
                        </a>
                    </div>

<!--                    --><?php //wp_nav_menu([
//                        'theme_location'  => 'header_nav',
//                        'container'       => 'nav',
//                        'container_class' => 'header__nav',
//                    ]); ?>

                    <nav class="header__nav">
                        <ul>
                            <li>
                                <a href="#">Політика</a>
                            </li>
                            <li>
                                <a href="#">Ідеї</a>
                            </li>
                            <li>
                                <a href="#">Культура</a>
                            </li>
                            <li>
                                <a href="#">Огляди</a>
                            </li>
                            <li>
                                <a href="#">Блоги</a>
                            </li>
                            <li>
                                <a href="#">
                                    <?php sprite( 29, 16, 'MazepaInstitute' ) ?>
                                </a>
                            </li>
                        </ul>
                    </nav>


                    <ul class="langs">
                        <li>
                            <a href="#" class="active">UA</a>
                        </li>
                        <li>
                            <a href="#">UA-L</a>
                        </li>
                        <li>
                            <a href="#">ENG</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>