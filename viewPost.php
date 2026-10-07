<?php require_once 'inc/header.php';
 require_once 'inc/conn.php'; ?>

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
       <?php require_once 'errors/update.php'; ?>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new Post</h4>
              <h2>add new personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      if(isset($_GET['id'])){
        $id=$_GET['id'];
      }else{
              header("location:./errors/404.php");
            exit();
      }
        $query="select * from posts where id =$id;";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)==1){
          $post=mysqli_fetch_assoc($result);
        }else{
                      header("location:./errors/404.php");
            exit();
        }
    ?>
    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2><?php if(isset($post)){echo $post['title'];}?></h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="./uploads/<?php if(isset($post)){echo $post['image'];}?>" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <!-- <h4>Who we are &amp; What we do?</h4> -->
              <h4><?php if(isset($post)){echo $post['title'];}?></h4>
              <p><?php if(isset($post)){echo $post['body'];}?></p>
              <p>created_at : <?php if(isset($post)){echo $post['created_at'];}?></p>
             <?php $queryjoin=" select * from users u join posts p on u.id=p.user_id where p.id=$id;";
             $resultjoin=mysqli_query($conn,$queryjoin);
            $post_user=mysqli_fetch_assoc($resultjoin);
             ?>
              <p> created_by : <?php if(isset($post)){echo $post_user['name'];}?></p>
              <?php 
              if(isset($_SESSION['user_id'])){
                $userid=$_SESSION['user_id'];
              if($post['user_id']===$userid){?>

              <div class="d-flex justify-content-center">
                  <a href="editPost.php?id=<?php if(isset($post)){echo $post['id'];}?>" class="btn btn-success mr-3 ">edit post</a>

              <form action="./handle/deletepost.php?id=<?php if(isset($post)){echo $post['id'];}?>" method="post">
                    <button class="alert alert-danger" name="submit" type="submit"> DELETE </button>
              </form>
              </div>
            <?php  }
              }

              ?>


            </div>
          </div>
        </div>
      </div>
</div>

    <?php require_once 'inc/footer.php' ?>
