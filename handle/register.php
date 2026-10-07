<?php
require_once '../inc/conn.php';
if(isset($_POST['submit'])){
    trim(htmlspecialchars(extract($_POST)));
    $errors=[];
    //name
    $name=trim($_POST['name'] ?? '');
    if(!isset($name) || empty($name)){
        $errors[]="The name is required!";
    }else if(is_numeric($name)){
        $errors[]="The name must be text!";
    }else if($name===''){
        $errors[]="The name must be text!";
    }
    //email
    if(!isset($email) || empty($email)){
        $errors[]="The email is required!";
    }else if(is_numeric($email)){
        $errors[]="The email must be text!";
    }else if(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
     $errors[]="The email must be correct email!";
    }else{
            $queryemail="select email from users where email='$email';";
            $result=mysqli_query($conn,$queryemail);
            if(mysqli_num_rows($result) > 0){
                        $errors[]='This email is used before,Use another email!';
                    }
        }
    //pass
        $password=trim($_POST['password'] ?? '');
        if(!isset($password) || empty($password)){
        $errors[]="The password is required!";
        }else if(strlen($password)<6){
        $errors[]="The password must be at least 6 character!";
        }else if($password===''){
        $errors[]="The password must be at least 6 character!";
        }

    //phone
        if(!isset($phone) || empty($phone)){
        $errors[]="The phone is required!";
        }else if(!is_numeric($phone)){
        $errors[]="The phone must be numbers!";
        }

        //reg
        $password=password_hash($password,PASSWORD_DEFAULT);
        if(empty($errors)){
            $query="insert into users(`name`,`email`,`password`,`phone`)values('$name','$email','$password','$phone');";
            $insert=mysqli_query($conn,$query);
            if($insert){
                // $_SESSION['success']="user registering is valid !!";
                header("location:../index.php");exit();
            }else{
                // $_SESSION['errors']="An error hanppend while register!!";
                $_SESSION['errors']=["An error hanppend while register!!"];
                    header("location:../register.php");exit();
            }
        }else{
            $_SESSION['name']=$name;
            $_SESSION['email']=$email;
            $_SESSION['phone']=$phone;
            $_SESSION['errors']=$errors;
            header("location:../register.php");exit();
        }

}else{
    header("location:../errors/404.php");exit();
}