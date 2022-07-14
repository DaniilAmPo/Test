<?php
$hash = $_GET['hash'];

$servername = "localhost";
$database = "id19271389_testbd";
$username = "id19271389_admin";
$password = "S9</B@oBUIc{OLq#";

$conn = mysqli_connect($servername, $username, $password, $database);

$sql = "UPDATE `User` SET `email_confirm` = true WHERE `User`.`hash` = '$hash';";
if (mysqli_query($conn, $sql)) {
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="main">
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">

                <h1 style = "margin-left: 5vw ">You have confirmed email</h1>


            </div>
            <a href="login.html" class="signup-image-link">Home</a>
        </div>
    </section>

</div>

<!-- JS -->

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>