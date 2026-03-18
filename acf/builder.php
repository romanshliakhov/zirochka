<?php
use StoutLogic\AcfBuilder\FieldsBuilder;

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    $builder = new FieldsBuilder('Builder', [
        // 'style' => 'seamless',
        'hide_on_screen' => [
            'the_content',
            'excerpt',
            'revisions',
            'editor',
        ],
    ]);

    $template_parts_dir = get_template_directory() . '/template_parts';

    $flex = $builder->addFlexibleContent('builder', [
        'label'        => false,
        'button_label' => __('Add section', 'ACF'),
    ]);

    $layouts_only = [];

    foreach (glob($template_parts_dir . '/section-*.php') as $template_file) {
        $layout_file_name = basename($template_file, '.php');
        $label            = ucwords(str_replace(['section-', '-', '_'], ['', ' ', ' '], $layout_file_name));

        $custom_fields_path = get_template_directory() . "/acf/builder_layout/{$layout_file_name}.fields.php";
        if (!file_exists($custom_fields_path)) continue;

        $returned = include $custom_fields_path;
        if (!$returned) continue;

        $layout_name = str_replace('-', '_', $layout_file_name);
        $fields      = call_user_func($layout_name, $layout_name . '_fields');


        if (isset($fields['only'])) {
            $only = (array) $fields['only'];
            $only = array_values(array_filter(array_map('sanitize_key', $only)));
            if ($only) {
                $layouts_only[$layout_name] = $only;
            }
        }

        $flex->addLayout($layout_name, [
            'label'   => $label,
            'display' => $fields['display'] ?? 'block',
        ])->addFields($fields['layout']);
    }

    $builder
        ->setLocation('post_template', '==', 'default')
        ->or('post_type', '==', 'news');

    acf_add_local_field_group($builder->build());

    add_filter('acf/prepare_field/name=builder', function ($field) use ($layouts_only) {
        if (empty($field['layouts']) || !is_array($field['layouts'])) {
            return $field;
        }

        $current_pt = get_current_post_type_safe();

        $existing = [];
        if (!empty($field['value']) && is_array($field['value'])) {
            foreach ($field['value'] as $row) {
                if (!empty($row['acf_fc_layout'])) {
                    $existing[(string) $row['acf_fc_layout']] = true;
                }
            }
        }

        $filtered = [];
        foreach ($field['layouts'] as $layout) {
            $name = isset($layout['name']) ? (string) $layout['name'] : '';
            if ($name === '') continue;

            $only = $layouts_only[$name] ?? [];

            if (empty($only) || isset($existing[$name]) || ($current_pt && in_array($current_pt, $only, true))) {
                $filtered[] = $layout;
            }
        }

        if ($filtered) {
            $field['layouts'] = $filtered;
        }

        return $field;
    });
});
