<?php
$shower = get_sub_field( 'shower' );
$list   = get_sub_field( 'list' );

if ( ! $shower && $list ) : ?>
    <section class="section-map">
        <div class="container">
            <div class="section-map__wrapp">
                <div class="section-map__frame" data-contacts-map></div>

                <div class="section-map__box">
                    <span><?php _e('Location', 'ACF'); ?></span>

                    <ul class="section-map__items">
                        <?php foreach ( $list as $item ) : 
                            $lat   = $item['lat'];
                            $lng   = $item['lng'];
                            $loc   = $item['loc'];
                            $tel   = $item['tel'];
                            $email = $item['email'];
                            ?>
                            <li>
                                <div class="section-map__item" data-lat="<?php echo esc_attr( $lat ); ?>" data-lng="<?php echo esc_attr( $lng ); ?>">
                                    <span class="section-map__item-icon">
                                        <?php sprite( 24, 24, 'MapPin' ); ?>
                                    </span>

                                    <div class="section-map__item-details">
                                        <?php if ($loc) : ?>
                                            <span class="section-map__item-location"><?= esc_html($loc); ?></span>
                                        <?php endif; ?>

                                        <?php if ( $tel ) :
                                            $tel_url    = $tel['url'];
                                            $tel_title  = $tel['title'];
                                            $tel_target = $tel['target'] ? $tel['target'] : '_self';
                                            ?>
                                            <a class="section-map__item-tel" href="<?php echo esc_url( $tel_url ); ?>" target="<?php echo esc_attr( $tel_target ); ?>">
                                                <?php sprite( 24, 24, 'phone' ); ?>
                                                <?php echo esc_html( $tel_title ); ?>
                                            </a>
                                        <?php endif; ?>

                                        <?php if ( $email ) :
                                            $email_url    = $email['url'];
                                            $email_title  = $email['title'];
                                            $email_target = $email['target'] ? $email['target'] : '_self';
                                            ?>
                                            <a class="section-map__item-email" href="<?php echo esc_url( $email_url ); ?>" target="<?php echo esc_attr( $email_target ); ?>">
                                                <?php sprite( 24, 24, 'email' ); ?>
                                                <?php echo esc_html( $email_title ); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
