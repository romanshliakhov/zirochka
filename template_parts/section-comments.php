<?php
	$shower  = get_sub_field( 'shower' );
	$editors = get_sub_field( 'editors' );
	$posts   = get_sub_field( 'posts' );



		if ( ! $shower ) : ?>

            <section class="section-comments" <?php if ( get_sub_field( 'section_id' ) ) : ?> id="<?php echo get_sub_field( 'section_id' ); ?>" <?php endif; ?>>
                <div class="container">
					<?php if ( post_password_required() ) {
						return;
					} ?>


                <!--        Заголовок. (размещай как угодно, тег так же можно менять)            -->

                    <div id="comments" class="section-comments__box">
                        <h4>
                            <?php $comments_number = get_comments_number();
                                printf(_n('%s Comment', '%s Comments', $comments_number, THEME_SLUG), $comments_number);
                            ?>
                        </h4>

						<?php if ( comments_open() ) : ?>
                            <form action="<?= site_url( '/wp-comments-post.php' ); ?>" method="post"
                                  class="comment-form js-comment-form" id="commentform">
                                <span class="comment-form__avatar">
                                    <span class="icon-user"></span>
                                </span>
                                <label for="author" class="comment-form__label">
                                    <input id="author" name="author" type="text" class="comment-form__input" placeholder="Your Name" required>
                                </label>
                                <label for="email" class="comment-form__label">
                                    <input id="email" name="email" type="email" class="comment-form__input" placeholder="Your Email" required>
                                </label>

                                <label for="comment" class="comment-form__label">
                                    <textarea id="comment" name="comment" class="comment-form__textarea" placeholder="Leave a Comment" required></textarea>
                                </label>

                                <button type="submit" class="main-button">Comment</button>

								<?php
									comment_id_fields();
									wp_nonce_field( 'comment_nonce_' . get_the_ID() );
								?>
                            </form>
						<?php endif; ?>


						<?php
							$comments = get_comments([
								'post_id' => get_the_ID(),
								'status'  => 'approve',
								'parent'  => 0,
							]);

							if ($comments): ?>
                                <ul class="comment-list">
									<?php foreach ($comments as $comment):
										$comment_id  = $comment->comment_ID;
										$author_id   = $comment->user_id;
										$is_admin    = user_can($author_id, 'manage_options');
										$acf_name    = $is_admin ? get_field('name', $comment->comment_post_ID) : '';
										$author_name = $is_admin && $acf_name ? $acf_name : get_comment_author($comment_id);
										$date        = get_comment_date('', $comment);
										?>
                                        <li class="comment-list__item">
                                            <div class="comment" data-clip>
                                                <div class="comment__avatar">
                                                    <span class="icon-user"></span>
                                                </div>
                                                <div class="comment__body">
                                                    <div class="comment__meta">
                                                        <span class="comment__author"><?= $comment->comment_author ?></span>
                                                        <span class="comment__date"><?= esc_html($date); ?></span>
                                                    </div>
                                                    <div class="comment__text editor" data-clip-item>
														<?= apply_filters('comment_text', $comment->comment_content, $comment); ?>
                                                    </div>
                                                    <button class='comment__more' data-clip-btn>More</button>
                                                </div>
                                            </div>

											<?php
												$children = get_comments([
													'post_id' => get_the_ID(),
													'status'  => 'approve',
													'parent'  => $comment_id,
												]);

												foreach ($children as $child):
													$child_author_id = $child->user_id;
													if (!user_can($child_author_id, 'manage_options')) continue;

													$child_acf_name  = get_field('name', $child->comment_post_ID);
													$child_author    = $child_acf_name ?: get_comment_author($child->comment_ID);
													$child_date      = get_comment_date('', $child);
													?>
                                                    <div class="comment reply" data-clip>
                                                        <div class="comment__meta">
                                                            <span class="comment__author">
                                                                <span class="icon-arrow-reverse"></span>
                                                                <?= esc_html($child_author); ?> <i>(Author)</i>
                                                            </span>
                                                            <span class="comment__date"><?= esc_html($child_date); ?></span>
                                                        </div>
                                                        <div class="comment__text editor" data-clip-item>
															<?= apply_filters('comment_text', $child->comment_content, $child); ?>
                                                        </div>
                                                        <button class='comment__more' data-clip-btn>More</button>
                                                    </div>
												<?php endforeach; ?>
                                        </li>
									<?php endforeach; ?>
                                </ul>
							<?php endif; ?>

                    </div>
            </section>

		<?php endif; ?>



