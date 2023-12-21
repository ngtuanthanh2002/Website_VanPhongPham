<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['admin']);
    setcookie('token', null, time() - 60*60*24*2);

    header('Location: index.php');