<?php

    ob_start();

    if( ($_SESSION['ulogin'] == "") || ($_SESSION['profile_id'] == "") ){
        //mensagem de erro
        $_SESSION['errorMessage'] = "Área restrita para usuários cadastrados!";
        //redireciona para tela de login
        header("Location: ../login.php");
    }

?>