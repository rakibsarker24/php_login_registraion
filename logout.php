<?php
    session_start();

    // session_destroy();
    unset($_SESSION['user']);
    unset($_SESSION['email']);

    header("location: login.php");
?>