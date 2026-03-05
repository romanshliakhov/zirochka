<?php
	function display_tabs( array $tabs, $class = '', $id = '' ): void {
		if ( ! $tabs ) {
			return;
		}
		?>
        <div class="<?= $class; ?>" data-tabs-parent id="<?= $id; ?>">
            <ul class="tabs-nav">
				<?php foreach ( $tabs as $index => $tab ) : ?>
                    <li class="tabs-nav__item">
                        <button class="tabs-nav__btn <?= $index === 0 ? 'active' : '' ?>" type="button"
                                data-tab="<?= $index + 1 ?>">
							<?= $tab['label'] ?>
                        </button>
                    </li>
				<?php endforeach; ?>
            </ul>

            <ul class="tabs-content">
				<?php foreach ( $tabs as $index => $tab ) : ?>
                    <li class="tabs-content__item <?= $index === 0 ? 'active' : '' ?>"
                        data-tab-content="<?= $index + 1 ?>">
                        <div class="">
							<?= $tab['editor'] ?>
                        </div>
                    </li>
				<?php endforeach; ?>
            </ul>
        </div>
		<?php
	}

?>
