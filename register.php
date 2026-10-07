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
    background-image: url('./backimage/backreg.jpg');
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
    min-height: 500px;
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
    color: #222;
}

.center-container p {
    margin: 0;
    color: #222;
}

.center-container a {
    color: #111;
    font-weight: bold;
    text-decoration: none;
}

.center-container a:hover {
    color: #000;
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
        min-height: 470px;
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
            <!-- <a href="index.php">Log in</a> -->
            <!-- <a href="Register.php">Register</a> -->
        </div>
    </div>
    <div>
    <?php
    require_once './inc/conn.php';
    require_once './errors/errors.php';
    require_once './errors/success.php';
?>

        <form class="form" action="handle/register.php" method="post">
            
            <h3>Register Here</h3>
            <input placeholder="Enter Name" class="input" type="text" name="name" id=""value="<?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}?>">
            <input placeholder="Enter Email" class="input" type="email" name="email" id=""value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?>">
            <input class="input" placeholder="Enter Password" type="password" name="password" id="">
            <input class="input" placeholder="Enter your phone " type="text" name="phone" id="" value="<?php if(isset($_SESSION['phone'])){echo $_SESSION['phone'];}?>">
            <button type="submit" name="submit">Register</button>
           
            

        </form>
                <div class="center-container">
            <p>Do You have account?</p>
            <a href="index.php">Log in</a>
        </div>
        <?php
if(isset($_SESSION['name'])){unset ($_SESSION['name']);}
if(isset($_SESSION['email'])){unset ($_SESSION['email']);}
if(isset($_SESSION['phone'])){unset ($_SESSION['phone']);}
?>
    </div>
</body>

</html>