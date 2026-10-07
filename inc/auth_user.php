<?php

require_once __DIR__ . '/conn.php';

if(isset($_SESSION['user_id'])){

    return;

}


if(isset($_SESSION['admin_id'])){

    header("location:../homeadmin.php");
    exit();

}


if(isset($_COOKIE['token'])){

    $token = $_COOKIE['token'];

    $query = "SELECT user_id, admin_id
              FROM tokens
              WHERE token_value = '$token'
              AND expires_at > NOW()";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){

        $data = mysqli_fetch_assoc($result);


        if(!empty($data['user_id'])){

            $_SESSION['user_id'] = $data['user_id'];

            return;
        }


        if(!empty($data['admin_id'])){

            $_SESSION['admin_id'] = $data['admin_id'];

            header("location:../homeadmin.php");
            exit();
        }
    }
}


setcookie('token', '', time() - 3600, "/");

header("location:../index.php");
exit();