<?php
// app/Helpers/language_helper.php

if (!function_exists('__')) {
    function __($key) {
        $lang = $_SESSION['lang'] ?? 'vi'; // Mặc định là tiếng Việt
        
        // Load the language file if not loaded
        static $langData = [];
        
        if (empty($langData[$lang])) {
            $langFile = ROOT_DIR . "/app/Language/{$lang}.php";
            if (file_exists($langFile)) {
                $langData[$lang] = require $langFile;
            } else {
                $langData[$lang] = [];
            }
        }

        $keys = explode('.', $key);
        $value = $langData[$lang];

        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $key; // Return key if not found
            }
        }

        return $value;
    }
}
?>
