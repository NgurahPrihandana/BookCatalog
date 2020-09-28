<?php 

class Flasher {
    public static function setFlash($title,$text,$tipe)
    {
        $_SESSION['flash'] = [
            'title' => $title,
            'text' => $text,
            'type' => $tipe
        ];
    }

    public static function setToast($title,$text,$tipe)
    {
        $_SESSION['toast'] = [
            'title' => $title,
            'text' => $text,
            'type' => $tipe
        ];
    }

    public static function flash()
    {
        if(isset($_SESSION['flash'])) {
            echo $_SESSION['flash']['title']."|".$_SESSION['flash']['text']."|".$_SESSION['flash']['type'];
        }
        unset($_SESSION['flash']);
    }

    public static function toast() {
        if(isset($_SESSION['toast'])) {
            echo $_SESSION['toast']['title']."|".$_SESSION['toast']['text']."|".$_SESSION['toast']['type'];
        }
        unset($_SESSION['toast']);
    }
}