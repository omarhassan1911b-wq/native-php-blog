<?php
require_once '../inc/conn.php';
if(!isset($_SESSION['admin_id'])){
    header("location:../index.php");
    exit();
}
if(isset($_POST['submit'])){
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="select * from posts where id=$id;";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)==1){
            $post=mysqli_fetch_assoc($result);
            $old_image=$post['image'];
            $querydelete="delete from posts where id=$id;";
            $delete=mysqli_query($conn,$querydelete);
            if($delete){
                if(!empty($old_image)){
                    unlink("../uploads/$old_image");
                }
                $_SESSION['delete']="post has been deleted";
                header("location:../homeadmin.php");exit();
            }else{
                // $_SESSION['errors']=["Something went wrong!"];
                 $_SESSION['errors']=[mysqli_error($conn)];
                header("location:../viewadmin.php?id=$id");exit();
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