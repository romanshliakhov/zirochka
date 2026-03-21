<?php
	$shower  = get_sub_field( 'shower' );
	$editor  = get_sub_field( 'editor' );

    $post_id   = get_the_ID();
    $post_id   = get_the_ID();
    $post_type = get_post_type($post_id);

    $authors = [];

    switch ($post_type) {
        case 'blog':
            $authors = get_field('blog', $post_id);
            break;

        case 'books':
            $authors = get_field('book', $post_id);
            break;

        case 'articles':
            $authors = get_field('articles', $post_id);
            break;
    }
    // Дата
    $date = get_the_date('d.m.y', $post_id);
    // Автор
    $author_name = '';
    $author_link = '';

    if (!empty($authors)) {
        $author_id   = $authors[0];
        $author_name = get_the_title($author_id);
        $author_link = get_permalink($author_id);
    }
	
	if ( ! $shower ) : ?>

        <section class="default-section" >
            <div class="container">
                <div class="default-section__box">
                    <div class="editor">
                        <?=$editor?>
                    </div>

                    <div class="default-section__bottom">
                        <?php if ($date): ?>
                          <span class="hero-section__info">
                            <i class="sprite"><?php sprite(16, 16, 'calendar') ?></i>
                            <?= esc_html($date); ?>
                          </span>
                        <?php endif; ?>
                        <?php if ($author_name): ?>
                            <span class="hero-section__info">
                                <i class="sprite"><?php sprite(16, 16, 'user') ?></i>
                                <a href="<?= esc_url($author_link); ?>">
                                    <?= esc_html($author_name); ?>
                                </a>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

	<?php endif; ?>