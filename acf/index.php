<?php
	$acfDirs = [
		__DIR__ . '/reuse',
		__DIR__ . '/cpt_fields',
		__DIR__ . '/menu',
		__DIR__ . '/options',
		__DIR__ . '/builder.php',
	];

	foreach ($acfDirs as $dir) {
		if (is_dir($dir)) {
			$files = glob($dir . '/*.php') ?: [];
			foreach ($files as $file) {
				require_once $file;
			}
		} elseif (is_file($dir)) {
			require_once $dir;
		}
	}

