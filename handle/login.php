<?php
require_once '../inc/conn.php';
$query = "DELETE FROM tokens WHERE expires_at <= NOW()";
mysqli_query($conn, $query);
if(isset($_COOKIE['token'])){
    $token = $_COOKIE['token'];
    $query="SELECT *  FROM tokens t JOIN users u 
    ON t.user_id = u.id WHERE t.token_value = '$token'AND t.expires_at > NOW()";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1){
        
         $alldata=mysqli_fetch_assoc($result);
         $user_id=$alldata['user_id'];
         $_SESSION['user_id']=$user_id;
        header("location:../Home.php");exit();
    }else{
    $query="SELECT *  FROM tokens t JOIN admins a 
    ON t.admin_id = a.id WHERE t.token_value= '$token' AND t.expires_at > NOW()";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1){
        $alldata=mysqli_fetch_assoc($result);
        $admin_id=$alldata['admin_id'];
         $_SESSION['admin_id']=$admin_id;  
        header("location:../homeadmin.php");
        exit();
    }else{
            setcookie('token', '', time() - 3600, "/");
            header("location:../index.php");
            exit();
    }}

}else{
    if(isset($_POST['submit'])){
    //login user
    $errors=[];
    $pass=$_POST['password'] ?? '';
    $email=trim(htmlspecialchars($_POST['email'] ?? ''));
        //email
        if(!isset($_POST['email']) || empty($email)){
            $errors[]='email is required';
        }else if(is_numeric($email)){
            $errors[]='email must be text!';
        }else if(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
            $errors[]="The email must be correct email!";
        }
        //pass
        if(!isset($_POST['password']) || empty($pass)){
            $errors[]='password is required!';
        }else if(strlen($pass)<6){
            $errors[]='password must be more than 6 letters!';
        }
//errors
        if(empty($errors)){
            $errorstoken=[];
            $query="select * from admins where email='$email';";
            $result=mysqli_query($conn,$query);
            if(mysqli_num_rows($result) == 1){
                //admin check
                $admindata=mysqli_fetch_assoc($result);
                $admin_id=$admindata['id'];
                 $adminpass=password_verify($pass, $admindata['password']);
                if($adminpass ===true && $admindata['email'] === $email){
                    $admin_id=$admindata['id'];
                    $token = bin2hex(random_bytes(32));//must hash token
                    $hashtoken= hash('sha256', $token);
                    $expires_at = date('Y-m-d H:i:s', strtotime('+6 months'));
                    $queryinsert="insert into tokens(admin_id,token_value,expires_at)values('$admin_id','$hashtoken','$expires_at');";
                    $insertadmin=mysqli_query($conn,$queryinsert);
                    if($insertadmin){
                        //secure modify it
                        setcookie('token', $hashtoken, time() + (6 * 30 * 24 * 60 * 60), "/", "");
                            $_SESSION['admin_id']=$admin_id;
                        header("location:../homeadmin.php");exit();
                    }else{
                            $errorstoken[]='Something went wrong!!';
                            $_SESSION['errorstoken']=$errorstoken;
                            
                            header("location:../index.php");exit();
                    }
                    
                }else{
                            $errorstoken[]='Email or Password Is Invalid!!';
                            $_SESSION['errorstoken']=$errorstoken;
                            header("location:../index.php");exit();
                }
                //user check 
            }else{
            $query="select * from users where email='$email';";
            $result=mysqli_query($conn,$query);
            if(mysqli_num_rows($result) == 1){
                $userdata=mysqli_fetch_assoc($result);
                $user_id=$userdata['id'];
                $userpass=password_verify($pass, $userdata['password']);
                    if($userpass ===true && $userdata['email'] === $email){
                    $token = bin2hex(random_bytes(32));//must hash token
                     $hashtoken= hash('sha256', $token);
                    $expires_at = date('Y-m-d H:i:s', strtotime('+6 months'));
                    $queryuserinsert="insert into tokens(user_id,token_value,expires_at)values('$user_id','$hashtoken','$expires_at');";
                    $insertuser=mysqli_query($conn,$queryuserinsert);
                    if($insertuser){
                    
                        $_SESSION['user_id']=$user_id;
                        setcookie('token', $hashtoken, time() + (6 * 30 * 24 * 60 * 60), "/", "");
                         header("location:../Home.php");exit();
                       
                     
                    }else{
                          $_SESSION['email']=$email;
                            $errorstoken[]='Something went wrong!!';
                            $_SESSION['errorstoken']=$errorstoken;
                            header("location:../index.php");exit();
                    }

                }else{
                      $_SESSION['email']=$email;
                       $errorstoken[]='Email or Password Is Invalid!!';
                       $_SESSION['errorstoken']=$errorstoken;
                       header("location:../index.php");exit();
                }
            }else{
  $_SESSION['email']=$email;
                        $errorstoken[]='Email is invalid please register fisrt!!';
                            $_SESSION['errorstoken']=$errorstoken;
                            header("location:../index.php");
    exit();
            }
            }

            // if(!empty($errorstoken)){
            //      $_SESSION['errorstoken']=$errorstoken;
            //      header("location:../index.php");exit();}

        }else{
            $_SESSION['email']=$email;
            $_SESSION['errors']=$errors;
            header("location:../index.php");exit();
        }

}else{
    header("location:../index.php");exit();
}
}
