<?php
// app/Controllers/LangController.php

class LangController extends Controller {
    public function change($lang = 'vi') {
        $allowed_langs = ['vi', 'en'];
        if (in_array($lang, $allowed_langs)) {
            $_SESSION['lang'] = $lang;
        }
        
        // Go back to the previous page
        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: " . BASEURL . "/home");
        }
        exit();
    }
}
?>
