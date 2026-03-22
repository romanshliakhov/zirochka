<?php get_header(); ?>

<?php
$global_setting = get_field('global_contacts', 'settings');
$data = $global_setting['page_404'] ?? [];

?>
    <section class="error-section">
        <div class="container">
            <div class="error-section__box">

                <?php
                if ($data):
                    $editor = $data['editor'] ?? '';
                    $image  = $data['image'] ?? null;
                    ?>

                    <?php display_image($image, 1360, 320); ?>

                    <div class="error-section__inner editor">
                        <?= $editor; ?>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </section>

<?php get_footer(); ?>