<?php

session_start();

if(isset($_SESSION['admin_id'])){
    header("Location: ../homeadmin.php");
    exit();
}

if(isset($_SESSION['user_id'])){
    header("Location: ../Home.php");
    exit();
}

header("Location: ../index.php");
exit();