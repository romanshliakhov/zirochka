<?php
	$shower  = get_sub_field( 'shower' );
    $video_desktop = get_sub_field('video_desktop');
    $video_mobile = get_sub_field('video_mobile');
	$editor = get_sub_field( 'editor' );
	
	if ( ! $shower ) : ?>
        <section class="section-banner" >
            <?php if ( $video_desktop ) : ?>
                <div class="section-banner__video video-desktop">
                    <video autoplay muted loop playsinline preload="auto">
                        <source src="<?php echo $video_desktop['url']; ?>" type="<?php echo $video_desktop['mime_type']; ?>">
                    </video>
                </div>
            <?php endif; ?>

            <?php if ( $video_mobile ) : ?>
                <div class="section-banner__video video-mobile">
                    <video autoplay muted loop playsinline preload="auto">
                        <source src="<?php echo $video_mobile['url']; ?>" type="<?php echo $video_mobile['mime_type']; ?>">
                    </video>
                </div>
            <?php endif; ?>

            <div class="container">
                <div class="section-banner__wrapp">
                    <div class="editor">
                        <?=$editor?>
                    </div>
                </div>
            </div>
        </section>
	<?php endif; ?>