<?php
require_once '../inc/conn.php';
if(isset($_SESSION['admin_id'])){
    $errors=[];
    $id=$_SESSION['admin_id'];
    $query="select * from admins where id=$id;";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1){
        $query="select * from tokens where admin_id=$id and expires_at > NOW()";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 1){
            $query="delete from tokens where admin_id=$id;";
            $delete=mysqli_query($conn,$query);
            if($delete){
            unset($_SESSION['admin_id']);
            setcookie('token', '', time() - 3600, "/");
            header("location:../index.php");
            exit();
            }else{
        $errors[]='Something went wrong!!';
        $_SESSION['errors'] = $errors;
        header("location:../homeadmin.php");exit();  
            }

        }else{
        $errors[]='Something went wrong!!';
        $_SESSION['errors'] = $errors;
        header("location:../homeadmin.php");exit();  
        }
    }else{
        $errors[]='Something went wrong!!';
        $_SESSION['errors'] = $errors;
        header("location:../homeadmin.php");exit();
    }
}else if(isset($_SESSION['user_id'])){
     $errors=[];
    $id=$_SESSION['user_id'];
    $query="select * from users where id=$id;";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1){
        $query="select * from tokens where user_id=$id and expires_at > NOW()";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 1){
            $query="delete from tokens where user_id=$id;";
            $delete=mysqli_query($conn,$query);
            if($delete){
            unset($_SESSION['user_id']);
            setcookie('token', '', time() - 3600, "/");
            header("location:../index.php");
            exit();
            }else{
        $errors[]='Something went wrong!!';
        $_SESSION['errors'] = $errors;
        header("location:../Home.php");exit();  
            }

        }else{
        $errors[]='Something went wrong!!';
        $_SESSION['errors'] = $errors;
        header("location:../Home.php");exit();  
        }
    }else{
        $errors[]='Something went wrong!!';
        $_SESSION['errors'] = $errors;
        header("location:../Home.php");exit();
    }
}