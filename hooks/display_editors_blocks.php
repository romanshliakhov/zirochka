<?php
	function display_editor_blocks( array $editors, $class = 'editors' ): void {
		if ( ! $editors ) return;
		?>
			<?php foreach ( $editors as $editor ) : ?>
                <div class="<?= $class;?>__coll editor">
					<?= $editor['editor']; ?>
                </div>
			<?php endforeach; ?>
		<?php
	}
?>
