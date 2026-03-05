<?php 
    add_shortcode('custom_select', function($atts) {
        $atts = shortcode_atts([
            'placeholder' => 'Select province',
            'name' => 'custom_select',
            'options' => '',
            'disabled' => '',
        ], $atts);

        $disabled = array_map('trim', explode(',', $atts['disabled']));
        $options = array_filter(array_map('trim', explode('|', $atts['options'])));

        if (empty($options)) return '';

        ob_start();
        ?>
        <div class="custom-select main-form__select" data-placeholder="<?= esc_html($atts['placeholder']) ?>" data-name="<?= esc_attr($atts['name']) ?>">
            <div class="select-field">
                <div class="selected-options">
                    <span class="placeholder"></span>
                </div>
                <div class="arrow-down">
                    <span class="icon-arrow-down"></span>
                </div>
            </div>
            <ul class="options-container">
                <?php foreach ($options as $index => $value): ?>
                    <?php
                    $is_disabled = in_array($value, $disabled);
                    $classes = 'option' . ($is_disabled ? ' disabled' : '');
                    ?>
                    <li class="<?= esc_attr($classes) ?>" data-value="<?= esc_attr($value) ?>">
                    <span class="option-text"><?= esc_html($value) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
        return ob_get_clean();
    });


    add_filter('wpcf7_form_elements', function($content) {
        return do_shortcode($content);
    });
    
