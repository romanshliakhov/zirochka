<?php
	function display_lang_list ( ): void {

		if (function_exists('icl_get_languages')) {
			$languages = apply_filters('wpml_active_languages', null, array('skip_missing' => 0));

			if (!empty($languages)):
				$activeLang = null;
				$otherLangs = [];

				foreach ($languages as $lang) {
					if ($lang['active']) {
						$activeLang = $lang;
					} else {
						$otherLangs[] = $lang;
					}
				}
				?>
				<div class="lang-switcher">
					<?php if ($activeLang): ?>
						<div class="lang-item active">
							<span data-lang="<?php echo esc_attr($activeLang['language_code']); ?>">
								<img width="16" height="16" src="<?php echo esc_url($activeLang['country_flag_url']); ?>" alt="<?php echo esc_attr($activeLang['native_name']); ?>" class="lang-flag">
								<span class="lang-code"><?php echo strtoupper($activeLang['language_code']); ?></span>
								<?= sprite('16','16','arrow-bottom')?>
							</span>
						</div>
					<?php endif; ?>

					<?php if (!empty($otherLangs)): ?>
						<ul class="lang-dropdown">
							<?php foreach ($otherLangs as $lang): ?>
								<li class="lang-item">
									<a href="<?php echo esc_url($lang['url']); ?>" data-lang="<?php echo esc_attr($lang['language_code']); ?>">
										<img src="<?php echo esc_url($lang['country_flag_url']); ?>" alt="<?php echo esc_attr($lang['native_name']); ?>" class="lang-flag">
										<span class="lang-code"><?php echo strtoupper($lang['language_code']); ?></span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif;
		}
	}
?>

