<?php

session_start();

$servername = "localhost";
$user = "root";
$password = "YOUR_DATABASE_PASSWORD";
$DBname = "blog_project";
$port = "3307";

$conn = mysqli_connect(
    $servername,
    $user,
    $password,
    $DBname,
    $port
);

if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}