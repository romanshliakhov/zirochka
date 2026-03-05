<?php use StoutLogic\AcfBuilder\FieldsBuilder;

	function editors($media = 0): FieldsBuilder {
		$field = new FieldsBuilder('editors_wrapper');

		$field
			->addRepeater('editors', [
				'label'        => __('Editors', 'ACF'),
				'button_label' => __('Add editor', 'ACF'),
				'wrapper'      => [
					'class' => 'admin-editors',
				],
				'max'    => 2,
				'layout' => 'block',
			])
			->addWysiwyg('editor', [
				'label'         => __('WYSIWYG Editor', 'ACF'),
				'tabs'          => 'full',
				'toolbar'       => 'all',
				'media_upload'  => $media,
				'delay'         => 0,
			])
			->endRepeater();

		return $field;
	}
