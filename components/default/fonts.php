<?php
	$font_dir = dirname(__DIR__, 2) . '/assets/fonts';
	$font_url = BUILD . 'fonts/';


	if (!is_dir($font_dir)) {
		error_log("Ошибка: Директория $font_dir не существует.");
		return;
	}

	$fonts = scandir($font_dir);
	if ($fonts === false) {
		error_log("Ошибка: Не удалось получить список файлов в $font_dir.");
		return;
	}

	$fonts = array_filter($fonts, function ($file) {
		return preg_match('/\.(woff2)$/i', $file);
	});

	foreach ($fonts as $font) {
		$font_type = (strpos($font, '.woff2') !== false) ? 'font/woff2' : 'font/woff';
		echo '<link rel="preload" href="' . $font_url . $font . '" as="font" type="' . $font_type . '" crossorigin="anonymous">' . "\n";
	}
