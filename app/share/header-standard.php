<?php

    ini_set('default_charset', 'utf-8');
    date_default_timezone_set('America/Sao_Paulo');
    session_cache_limiter('private, must-revalidate'); 
    session_cache_expire(120);
    session_start();

    define('VCLASSES', 'share/classes/');
    define('VCONFIG', 'share/config/');
    define('DEF_IMAGE', 'ial.png');

    spl_autoload_register(function($class) {
        include VCLASSES.$class.'.php';
    });

    require_once('../publico/vendor/autoload.php');

    include_once("share/envia-mail.php");

?>