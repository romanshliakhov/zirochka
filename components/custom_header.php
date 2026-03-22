<?php
$languages = apply_filters('wpml_active_languages', NULL, array('skip_missing' => 0));
$header = get_field('header', 'header');

if ($header) {
    $logo = $header['logo'];
}
?>

<header class="header fixed-block"
        role="banner" <?php if (get_field('header_footer_enabler', get_the_ID())) : ?> style="display:none;" <?php endif; ?>>
    <div class="container">
        <div class="header__box">
            <div class="header__top">
                <button class="burger">
                    <span class="burger__line"></span>
                </button>

                <a class="header__logo" href="<?php echo home_url(); ?>" aria-label="logo">
                    <img
                            src="<?php echo esc_url($logo['url']); ?>"
                            alt="<?php echo esc_attr($logo['alt'] ?: 'logo'); ?>"
                            width="166"
                            height="54"
                    >
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
                            <a href="#">EN<b>G</b></a>
                        </li>
                    </ul>

                    <form class="search-form">
                        <button data-btn-modal="search" class="search-form__btn">
                            <?php sprite(20, 20, 'search') ?>
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
                            <?php sprite(166, 54, 'logo') ?>
                        </a>
                    </div>

                    <?php wp_nav_menu([
                        'theme_location' => 'header_nav',
                        'container' => 'nav',
                        'container_class' => 'header__nav',
                    ]); ?>

                    <ul class="langs">
                        <li>
                            <a href="#" class="active">UA</a>
                        </li>
                        <li>
                            <a href="#">UA-L</a>
                        </li>
                        <li>
                            <a href="#">EN</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>