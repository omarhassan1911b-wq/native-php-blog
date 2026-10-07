<?php
require_once '../inc/conn.php';
if(isset($_POST['submit'])){
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="select * from posts where id=$id;";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)==1){
            $post=mysqli_fetch_assoc($result);

              if(isset($_SESSION['user_id'])){
                $userid=$_SESSION['user_id'];
              if($post['user_id'] == $userid){
            $old_image=$post['image'];
            $querydelete="delete from posts where id=$id;";
            $delete=mysqli_query($conn,$querydelete);
            if($delete){
                if(!empty($old_image)){
                    unlink("../uploads/$old_image");
                }
                $_SESSION['delete']="post has been deleted";
                header("location:../Home.php");exit();
                }else{
               $_SESSION['errors']=["Something went wrong!"];
                header("location:../viewPost.php?id=$id");exit();
                }}else{
                $_SESSION['errors']=["Something went wrong!"];
                header("location:../viewPost.php?id=$id");exit();
                }
            }else{
                $_SESSION['errors']=["Something went wrong!"];
                header("location:../viewPost.php?id=$id");exit();
            }
        }else{
            header("location:../errors/404.php");exit();
        }
    }else{
 header("location:../errors/404.php");exit();
    }
}else{
 header("location:../errors/404.php");exit();
}