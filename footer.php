<?php
$build_folder = get_template_directory_uri() . '/assets/';
$global_setting = get_field('global_contacts', 'settings');
$header = get_field('header', 'header');
$footer = get_field('footer', 'footer');
$logo = get_field('logo', 'footer');
$socials = $global_setting['social'] ?? [];
?>

</main>

<footer class="footer" <?php if (get_field('header_footer_enabler', get_the_ID())) : ?> style="display:none;" <?php endif; ?>>
    <div class="container">
        <div class="footer__wrapp">
            <a class="footer__logo" href="<?php echo home_url(); ?>" aria-label="logo">
                <img
                        src="<?php echo esc_url($logo['url']); ?>"
                        alt="<?php echo esc_attr($logo['alt'] ?: 'logo'); ?>"
                        width="166"
                        height="54"
                >
            </a>

            <?php wp_nav_menu([
                'theme_location' => 'footer_nav',
                'container' => 'nav',
                'container_class' => 'footer-nav',
            ]); ?>

            <?php if ($socials) : ?>
                <div class="footer__socials">
                    <span class="footer__socials-title"><?php echo __('Наші соцмережі', 'zirochka') ?></span>
                    <ul class="footer__socials-list">
                        <?php foreach ($socials as $social) :
                            $link = $social['social_link'] ?? null;
                            $image = $social['social_image'] ?? null;

                            $url = $link['url'] ?? '#';
                            $title = $link['title'] ?? '';
                            $target = $link['target'] ?? '_self';
                            ?>

                            <li>
                                <a href="<?= esc_url($url); ?>" target="<?= esc_attr($target); ?>">

                                    <?php
                                    if ($image && !empty($image['ID'])) {
                                        $path = get_attached_file($image['ID']);

                                        if ($path && file_exists($path)) {
                                            echo '<i class="sprite">';
                                            echo file_get_contents($path);
                                            echo '</i>';
                                        }
                                    }
                                    ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            <?php endif; ?>
        </div>
    </div>
</footer>

<?php
load_template(get_template_directory() . '/components/modals.php', true);
wp_footer();
?>
</body>
</html>
