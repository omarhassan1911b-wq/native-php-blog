<?php
require_once '../inc/conn.php';
if(isset($_POST['submit'])){
trim(htmlspecialchars(extract($_POST)));
$errors=[];
//title
$title=trim($_POST['title'] ?? '');
if(isset($_POST['title'])){
if(empty($title)){
$errors[]="Title is required!";
}else if(is_numeric($title)){
   $errors[]="Title must be Text!";
}
}else if($title===''){
    $errors[]="Title is required!";

}else{
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
//image
if(isset($_FILES['image'])){
    $image=$_FILES['image'];
    $vali_ex=['image/jpeg','image/png'];
    if($image['error']!==0){
    $errors[]="the Image is not correct!";
    }else {
            $size=$image['size']/(1024*1024);
    $mime_type=mime_content_type($_FILES['image']['tmp_name']);
        if($size > 2){
        $errors[]="the size must be smaller than 2 mg !";
    }else if(!in_array($mime_type,$vali_ex)){
        $errors[]="image must be jpg or png";
    }
}
}else{
    header("location:../errors/404.php");
    exit();
}

    if(empty($errors)){
        $name=$_FILES['image']['name'];
        $ex=strtolower(pathinfo($name,PATHINFO_EXTENSION));
        $new_name=uniqid().".".$ex;
        if(isset($_SESSION['user_id'])){
            $id=$_SESSION['user_id'];
             $query="insert into posts(`title`,`body`,`image`,`user_id`)values('$title','$body','$new_name',$id);";
        }else{
        $_SESSION['errors']=["there is an error!"];
        header("location:../addPost.php");
        exit();

        }
        // $query="insert into posts(`title`,`body`,`image`,`user_id`)values('$title','$body','$new_name',1);";
        $insert=mysqli_query($conn,$query);
        if($insert){
            move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$new_name);
            $_SESSION['success']="post has been added successfully!";
            header("location:../Home.php");exit();
        }else{
        $_SESSION['errors']=["there is an error!"];
        header("location:../addPost.php");
        exit();
        }
    }else{
        $_SESSION['title']=$title;
        $_SESSION['body']=$body;
        $_SESSION['errors']=$errors;
        header("location:../addPost.php");
        exit();
    }

}else{
        header("location:../addPost.php");
        exit();
}