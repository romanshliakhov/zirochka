<?php
	$shower  = get_sub_field( 'shower' );
	$editor = get_sub_field( 'editor' );
    $posts  = get_sub_field('posts');
	$link = get_sub_field( 'link' );
	
	if ( ! $shower ) : ?>

        <section class="section-services" >
            <div class="container">
                <div class="section-services__inner">
                    <div class="editor">
                        <?=$editor?>
                    </div>

                    <?php if (!empty($posts)) : ?>
                        <div class="services-list">
                            <?php foreach ($posts as $post_id) :
                                $image     = get_the_post_thumbnail($post_id, 'full');
                                $title     = get_the_title($post_id);
                                $permalink = get_permalink($post_id);
                            ?>
                                <div class="services-list__item">
                                    <?php if (have_rows('tags', $post_id)) : ?>
                                        <ul class="tags">
                                            <?php while (have_rows('tags', $post_id)) : the_row(); 
                                                $tag_link = get_sub_field('link');
                                                if ($tag_link) : ?>
                                                    <li class="tags__item">
                                                        <a href="<?= esc_url($tag_link['url']); ?>" target="<?= esc_attr($tag_link['target'] ?? '_self'); ?>">
                                                            <?= esc_html($tag_link['title']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>

                                    <a class="services-list__item-box" href="<?= esc_url($permalink); ?>">
                                        <?php if ($image) : ?>
                                            <div class="services-list__image">
                                                <?= $image; ?>
                                            </div>
                                        <?php endif; ?>

                                        <h3 class="services-list__title"><?= esc_html($title); ?></h3>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $link ) :
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="button button--red" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                            <?php echo esc_html( $link_title ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

	<?php endif; ?>



