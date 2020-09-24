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

    public static function flash()
    {
        if(isset($_SESSION['flash'])) {
            echo $_SESSION['flash']['title']."|".$_SESSION['flash']['text']."|".$_SESSION['flash']['type'];
        }
        unset($_SESSION['flash']);
    }
}