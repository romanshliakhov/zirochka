<?php
$shower = get_sub_field('shower');
$hero_sections       = get_sub_field( 'hero_section' );


if (!$shower) : ?>
    <?php
    	if ( $hero_sections ) :
		foreach ( $hero_sections as $hero ) :

            if ( $hero['acf_fc_layout'] === 'hero_1' ) :
                $main_title = $hero['editor'] ?? '';
                $section_id = get_field('section_id');
                $articles = $hero['selected_articles'] ?? [];
                $term = get_queried_object();
                $title_cat = ($term && !is_wp_error($term)) ? $term->name : '';



                if (!empty($articles) && isset($articles[0])) :
                    $post_id = $articles[0];
                    $title = get_the_title($post_id);
                    $excerpt = get_the_excerpt($post_id);
                    $post_type = get_post_type($post_id);

                    if ($post_type === 'articles') {

                        $authors = get_field('articles', $post_id);

                        if ($authors) {
                            $author_id = $authors[0];
                            $author_name = get_the_title($author_id);
                            $author_link = $authors ? get_permalink($author_id) : '';
                        }

                    } elseif ($post_type === 'books') {
                        $authors = get_field('books', $post_id);
                        $deskr = get_field('description', $post_id);

                        if ($authors) {
                            $author_id = $authors[0];
                            $author_name = get_the_title($author_id);
                            $author_link = $authors ? get_permalink($author_id) : '';
                        }

                    } elseif ($post_type === 'blog') {
                        $authors = get_field('blog', $post_id);
                        $deskr = get_field('excerpt', $post_id);

                        if ($authors) {
                            $author_id = $authors[0];
                            $author_name = get_the_title($author_id);
                            $author_link = $authors ? get_permalink($author_id) : '';
                        }
                    }

                    $date = get_the_date('d.m.y', $post_id);
                    $time = get_the_time('U', $post_id);

                    $tags = get_the_terms($post_id, 'article_tag');
                    $tag_name = ($tags && !is_wp_error($tags)) ? $tags[0]->name : '';

                    $thumb_id = get_post_thumbnail_id($post_id);
                    $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
                    $alt       = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';

                    // Категория
                    $category_class = '';

                    if (!is_front_page()) {
                        $terms = get_the_terms($post_id, 'article_category');

                        if ($terms && !is_wp_error($terms)) {
                            $category_slug = $terms[0]->slug;

                            switch ($category_slug) {
                                case 'polityka':
                                    $category_class = 'is-politics';
                                    break;

                                case 'kultura':
                                    $category_class = 'is-culture';
                                    break;

                                case 'oglyady':
                                    $category_class = 'is-reviews';
                                    break;

                                case 'ideyi':
                                    $category_class = 'is-ideas';
                                    break;
                            }
                        }
                    }
                    ?>
                    <?php if (!is_front_page()) : ?>
                        <?php if ($post_type === 'books' || $post_type === 'articles') : ?>
                            <div class="main-title">
                                <div class="container">
                                    <h1 class="h1"><?= esc_html($title_cat); ?></h1>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($post_type === 'blog') : ?>
                            <?php $title_cat = get_the_title(get_option('page_for_posts')) ?>
                            <div class="main-title">
                                <div class="container">
                                    <h1 class="h1"><?= esc_html($title_cat); ?></h1>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <section class="hero-section <?= $post_type === 'blog' ? 'hero-section--blog' : ''; ?> <?= esc_attr($category_class); ?>">
                        <div class="container">
                            <div class="hero-section__box">
                                <div class="hero-section__inner">
                                <span class="h3">
                                    <i class="sprite"><?php sprite(29, 28, 'star_icon') ?></i>
                                       <?= esc_html($main_title); ?>
                                </span>

                                    <div class="editor">
                                        <p class="h1"><?= esc_html($title); ?></p>

                                          <?php if ($excerpt): ?>
                                                <p><?= esc_html($excerpt); ?></p>
                                          <?php endif; ?>

                                        <?php if ($post_type === 'books') : ?>
                                            <p><?= esc_html($deskr); ?></p>
                                        <?php endif; ?>
                                        <?php if ($post_type === 'blog') : ?>
                                            <p><?= esc_html(wp_strip_all_tags($deskr)); ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="hero-section__bottom">
                                        <span class="hero-section__info">
                                            <i class="sprite"><?php sprite(16, 16, 'clock') ?></i>
                                            <?= esc_html(custom_time_ago($time)); ?>
                                        </span>
                                        <span class="hero-section__info">
                                            <i class="sprite"><?php sprite(16, 16, 'calendar') ?></i>
                                            <?= esc_html($date); ?>
                                        </span>
                                        <?php if ($author_name): ?>
                                            <span class="hero-section__info">
                                                <i class="sprite"> <?php sprite(16, 16, 'user') ?> </i>
                                                 <a href="<?= esc_url($author_link); ?>"><?= esc_html($author_name); ?></a>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="hero-section__image <?= $post_type === 'books' ? 'hero-section__image--book' : ''; ?>">
                                    <?php if ($thumb_id): ?>
                                        <img src="<?= esc_url($thumb_url); ?>" alt="<?= esc_attr($alt ?: $title); ?>" loading="lazy">
                                    <?php endif; ?>
                                    <?php if ($tags && !is_wp_error($tags)) : ?>
                                        <?php foreach ($tags as $tag) : ?>
                                            <?php $tag_link = get_term_link($tag); ?>
                                            <?php if (!is_wp_error($tag_link)) : ?>
                                                <a href="<?= esc_url($tag_link); ?>" class="tag"># <?= esc_html($tag->name); ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </section>

                <?php
                endif;
            endif;

			if ( $hero['acf_fc_layout'] === 'hero_2' ) :
				$section_id = get_field( 'section_id' );
				$editor = $hero['editor'] ?? [];
				$bg = $hero['image'] ?? []; ?>

                <section class="hero-section" <?= $section_id ? 'id="' . esc_attr( $section_id ) . '"' : ''; ?>>
                    <div class="container">
                        <div class="hero-section__box">
                            <div class="hero-section__inner">
                                <?php if (!empty($editor)) : ?>
                                    <div class="editor">
                                        <?= wp_kses_post($editor); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if ($bg): ?>
                                <?= display_image($bg, 870, 706, 'hero-section__image'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
			<?php endif;

            if ( $hero['acf_fc_layout'] === 'hero_3' ) :
                $section_id = get_field( 'section_id' );
                $editor = $hero['editor'] ?? [];
                $bg = $hero['image'] ?? []; ?>

                <section class="hero-section small" <?= $section_id ? 'id="' . esc_attr( $section_id ) . '"' : ''; ?>>
                    <div class="container">
                        <div class="hero-section__box">
                            <div class="hero-section__inner">
                                <?php if (!empty($editor)) : ?>
                                    <div class="editor">
                                        <?= wp_kses_post($editor); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if ($bg): ?>
                                <?= display_image($bg, 870, 706, 'hero-section__image'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php endif;

            if ( $hero['acf_fc_layout'] === 'hero_4' ) :
                $section_id = get_field( 'section_id' );
                $editor = $hero['editor'] ?? [];
                $bg = $hero['image'] ?? []; ?>

                <section class="hero-section public" <?= $section_id ? 'id="' . esc_attr( $section_id ) . '"' : ''; ?>>
                    <div class="container">
                        <div class="hero-section__box">
                            <div class="hero-section__inner">
                                <?php if (!empty($editor)) : ?>
                                    <div class="editor">
                                        <?= wp_kses_post($editor); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if ($bg): ?>
                                <?= display_image($bg, 500, 270, 'hero-section__image'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php endif;
		endforeach;
	endif; ?>

<?php endif; ?>