<?php 
    $build_folder = get_template_directory_uri() . '/assets/';
    $global_setting = get_field('global_contacts', 'settings');
    $header = get_field('header', 'header');
    $footer   = get_field('footer', 'footer'); 

//    if($global_setting) {
//        $tel_rent = $global_setting['tel_rent'];
//        $tel_sell = $global_setting['tel_sell'];
//        $worktime = $global_setting['worktime'];
//        $instagram_link = $global_setting['instagram'];
//        $facebook_link = $global_setting['facebook'];
//        $youtube_link = $global_setting['youtube'];
//        $tiktok_link = $global_setting['tiktok'];
//    }
//
//    if ($header) {
//        $logo = $header['logo'];
//    }
//
//    if ($footer) {
//        $location_link = $footer['location_link'];
//        $footer_text = $footer['footer_text'];
//        $partners = $footer['partners'];
//    }
?>

</main>

<footer class="footer" <?php if (get_field('header_footer_enabler', get_the_ID())) : ?> style="display:none;" <?php endif; ?>>
     <div class="container">
        <div class="footer__wrapp">
            <a class="footer__logo" href="<?php echo home_url(); ?>" aria-label="logo">
                <?php sprite( 166, 54, 'logo' ) ?>
            </a>

            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="#">Про нас</a>
                    </li>
                    <li>
                        <a href="#">Звʼязатись з нами</a>
                    </li>
                    <li>
                        <a href="#">Політика конфіденційності</a>
                    </li>
                    <li>
                        <a href="#">Правила користування</a>
                    </li>
                    <li>
                        <a href="#">
                            <?php sprite( 29, 16, 'MazepaInstitute' ) ?>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="footer__socials">
                <span class="footer__socials-title">Наші соцмережі</span>
                <ul class="footer__socials-list">
                    <li>
                        <a href="#">
                            <?php sprite(24, 24, 'Instagram'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <?php sprite(24, 24, 'X'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <?php sprite(24, 24, 'Telegram'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <?php sprite(24, 24, 'fb'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
     </div>
</footer>

<?php
    load_template(get_template_directory() . '/components/modals.php', true);
    wp_footer(); 
?>
</body>
</html>
