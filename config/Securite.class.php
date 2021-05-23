<?php

class Securite {
    public static function secureHTML($string){
        return htmlentities($string);
    }

    public static function generateCookiePassword(){
        $ticket = session_id().microtime().rand(0,9999999);
        $ticket = hash("sha512", $ticket);
        setcookie(COOKIE_PROTECT, $ticket, time() + (60 * 20));
        $_SESSION[COOKIE_PROTECT] = $ticket;
    }

    public static function verificationAccess(){
        return (isset($_SESSION['access']) && !empty($_SESSION['access']) && $_SESSION['access'] === "user");
    }
}