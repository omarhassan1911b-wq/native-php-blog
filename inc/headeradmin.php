<?php
require_once './inc/conn.php';
require_once './inc/auth_admin.php';

if(!isset($_SESSION['lang'])){
    $_SESSION['lang'] = "ar";
}

if($_SESSION['lang'] == "en"){
    require_once './inc/en.php';
}else{
    require_once './inc/ar.php';
}
?>


<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Blog</title>
<link rel="icon" type="image/png" href="./backimage/feature-image.jpg">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

    TemplateMo 546 Sixteen Clothing

    https://templatemo.com/tm-546-sixteen-clothing

    -->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
<!-- SweetAlert2 CSS & JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
  .swal2-container {
    z-index: 999999 !important;
  }
  .swal2-container.swal2-top-end, .swal2-container.swal2-right {
    top: 80px !important;
  }
</style>
  </head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader" >
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="padding-0">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
<a class="navbar-brand" href="index.php">
    <h2>
        <i class="fa fa-book"></i>
        <em><?php echo $data['Blog'];?></em>
    </h2>
</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="homeadmin.php"><?php echo $data['All Posts'];?>
                  <span class="sr-only">(current)</span>
                </a>
              </li> 

<?php
if($_SESSION['lang'] == "ar"){
?>
    <li class="nav-item">
        <a class="nav-link" href="./handle/changelang.php?lang=en">English</a>
    </li>
<?php
}else{
?>
    <li class="nav-item">
        <a class="nav-link" href="./handle/changelang.php?lang=ar">العربية</a>
    </li>
<?php
}
?>
              <li class="nav-item">
                <a class="nav-link" href="./handle/logout.php"><?php echo $data['Logout'];?></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>