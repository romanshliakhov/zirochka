<?php
    function get_share($type = 'fb', $permalink = false, $title = false) {
        if (!$permalink) {
            $permalink = get_permalink();
        }
        if (!$title) {
            $title = get_the_title();
        }

        switch ($type) {
            case 'fb':
                return 'https://www.facebook.com/sharer.php?u=' . urlencode($permalink);
            case 'telegram':
                return 'https://t.me/share/url?url=' . urlencode($permalink) . '&text=' . urlencode($title);
            case 'whatsapp':
                return 'https://api.whatsapp.com/send?text=' . urlencode($title . ' ' . $permalink);
            case 'viber':
                return 'viber://forward?text=' . urlencode($title . ' ' . $permalink);
            default:
                return '#';
        }
    }