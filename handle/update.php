<?php
require_once '../inc/conn.php';
if(isset($_POST['submit']) && isset($_GET['id'])){
$id=$_GET['id'];
$query="select * from posts where id=$id";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==1){
    $post=mysqli_fetch_assoc($result);
        if(isset($_SESSION['user_id'])){
        $userid=$_SESSION['user_id'];
        if($post['user_id'] == $userid){
    $old_image=$post['image'];


    ///////////////////////////////
    trim(htmlspecialchars(extract($_POST)));
$errors=[];
//title
if(isset($_POST['title'])){
if(empty($title)){
$errors[]="Title is required!";
}else if(is_numeric($title)){
   $errors[]="Title must be Text!";
}}else{
    $errors[]="add a title";
}
//body
if(isset($_POST['body'])){
if(empty($body)){
$errors[]="body is required!";
}else if(is_numeric($body)){
   $errors[]="body must be Text!";
}
}else{
 $errors[]="add a body";
}

/////////////////image

if(!empty($_FILES['image']['name'])){
        $image=$_FILES['image'];
        $vali_ex=['image/jpeg','image/png'];
            if($image['error']!==0){
                $errors[]="the Image is not correct!";
            }else{
                $size=$image['size']/(1024*1024);
                $mime_type=mime_content_type($_FILES['image']['tmp_name']);
            if($size > 2){
                $errors[]="the size must be smaller than 2 mg !";
            }else if(!in_array($mime_type,$vali_ex)){
                $errors[]="image must be jpg or png";
            }};
                $name=$_FILES['image']['name'];
                $ex=strtolower(pathinfo($name,PATHINFO_EXTENSION));
                $new_name=uniqid().".".$ex;
                    if(empty($errors)){
                     $query="update posts set title='$title', body='$body', image='$new_name' where id =$id;";
                     $update=mysqli_query($conn,$query);
                            if($update){
                         unlink("../uploads/$old_image");
                         move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$new_name);
                    $_SESSION['update']="post has been updated successfully!";
                     header("location:../viewPost.php?id=$id");exit();
                }else{
                $_SESSION['errors']=["there is an error!"];
                header("location:../editPost.php?id=$id");
                exit();
                }
    }else{
        $_SESSION['title']=$title;
        $_SESSION['body']=$body;
        $_SESSION['errors']=$errors;
        header("location:../editPost.php?id=$id");
        exit();
    }

}else{

    $new_name=$old_image;
        if(empty($errors)){
        $query="update posts set title='$title',body='$body',image='$new_name' where id =$id;";
        $update=mysqli_query($conn,$query);
        if($update){
            // unlink("../uplodas/$old_image");
            // move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$new_name);
            $_SESSION['update']="post has been updated successfully!";
            header("location:../viewPost.php?id=$id");exit();
        }else{
        $_SESSION['errors']=["there is an error!"];
        header("location:../editPost.php?id=$id");
        exit();
        }
    }else{
        $_SESSION['title']=$title;
        $_SESSION['body']=$body;
        $_SESSION['errors']=$errors;
        header("location:../editPost.php?id=$id");
        exit();
    }
}



}else{
    header("location:../errors/404.php");
    exit();
}}else{
     header("location:../errors/404.php");exit();
}}}