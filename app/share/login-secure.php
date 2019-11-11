<?php

    ob_start();

    if( ($_SESSION['ulogin'] == "") || ($_SESSION['profile_id'] == "") ){
        //mensagem de erro
        $_SESSION['errorMessage'] = "Área restrita para usuários cadastrados!";
        //redireciona para tela de login
        header("Location: ../login.php");
    }

    $username = $_SESSION['ulogin'];
    $password = $_SESSION['upaswd'];
    $user_id = $_SESSION['user_id'];
    $profile_id = $_SESSION['profile_id'];
    $email = $_SESSION['email'];
    $contact_id = $_SESSION['contact_id'];
    $fullname = $_SESSION['fullname'];
    $name = $_SESSION['name'];

    $acesso   =    User::getInstance();
    $contato  = Contact::getInstance();
    $endereco = Address::getInstance();

    $acesso->setSaveId($contact_id);
    $contato->setSaveId($contact_id);
    $endereco->setSaveId($contact_id);

    $acesso->setLogin($username);
    $acesso->setPassword($password);

    if(!$acesso->passwordCheck() )
        header("Location: login.php");


?>