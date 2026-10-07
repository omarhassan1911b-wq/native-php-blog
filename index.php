<?php
require_once './inc/conn.php';
if(isset($_COOKIE['token'])){

    $token = $_COOKIE['token'];

    $query = "SELECT * FROM tokens
              WHERE token_value = '$token'
              AND expires_at > NOW()";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){

        $data = mysqli_fetch_assoc($result);

        if(!empty($data['user_id'])){
            $_SESSION['user_id'] = $data['user_id'];
            header("location:./Home.php");
            exit();
        }

        if(!empty($data['admin_id'])){
            $_SESSION['admin_id'] = $data['admin_id'];
            header("location:./homeadmin.php");
            exit();
        }
    }else{
              setcookie('token', '', time() - 3600, "/");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="icon" type="image/png" href="./backimage/feature-image.jpg">
    <style>
       * {
    box-sizing: border-box;
}

html,
body {
    margin: 0;
    padding: 0;
    width: 100%;
    min-height: 100%;
}

body {
    min-height: 100vh;
    min-height: 100svh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px 20px;
    background-image: url('./backimage/homepage.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow-x: hidden;
}

.nav {
    display: none;
}

body > div:last-child {
    width: 100%;
    max-width: 430px;
}

.form {
    width: 100%;
    min-height: 425px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    padding: 30px;
    background-color: rgba(255, 255, 255, 0.42);
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    border-radius: 30px;
}

.input {
    width: 100%;
    max-width: 300px;
    height: 45px;
    padding: 10px;
    border: none;
    outline: none;
    border-radius: 10px;
}

form button {
    border: none;
    padding: 10px 20px;
    border-radius: 10px;
    color: white;
    background-color: #03a9f4;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #8000ff;
}

.center-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 15px;
    flex-wrap: wrap;
    color: white;
}

.center-container p {
    margin: 0;
}

.center-container a {
    color: white;
    font-weight: bold;
    text-decoration: none;
}

.center-container a:hover {
    text-decoration: underline;
}

.wrong {
    color: red;
}

@media (max-width: 500px) {
    body {
        padding: 20px 15px;
    }

    .form {
        padding: 25px 20px;
        min-height: 390px;
        border-radius: 20px;
    }

    .input {
        max-width: 100%;
    }
}
    </style>
</head>

<body>
    <div class="nav">
        <div class="links">
        </div>
    </div>
    <div>
    <?php
    require_once './inc/conn.php';
    require_once './errors/errors.php';
    require_once './errors/errorstoken.php';
    ?>
        <form class="form" action="./handle/login.php" method="post">
            <h3>Login Here</h3>
            <input placeholder="Enter Email" class="input" type="email" name="email" id="" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?>">
            <input class="input" placeholder="Enter Password" type="password" name="password" id="">
            <button type="submit" name="submit">Login</button>
        </form>
        <div class="center-container">
            <p>Don't have account?</p>
            <a href="register.php">Register</a>
        </div>
        <?php unset($_SESSION['email']);?> 
    </div>
</body>

</html>