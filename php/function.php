<?php
function connect(){
    $servername = "localhost";
    $database = "id19271389_testbd";
    $username = "id19271389_admin";
    $password = "S9</B@oBUIc{OLq#";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
function register(){

    $conn = connect();
    $email = $_POST["Email"];
    $sql = "SELECT `Email` FROM `User` WHERE `Email` = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $out = "false";
        echo "false";
        echo json_encode($out);
    } else {
        $Name = $_POST['Name'];
        $pass = $_POST["pass"];
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $hash = substr(str_shuffle($permitted_chars), 0, 10);

        $sql = "INSERT INTO User (Name, Email, password, email_confirm, hash) VALUES ('$Name', '$email', '$pass', 0, '$hash')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            sendmass($hash,$email);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}

function sendmass($hash,$email){
$to = $email;


$subject = 'Mail confirmation';


$message = '
<html>
<head>
  <title>Mail confirmation</title>
</head>
<body>
  <a href="https://myworktestdp.000webhostapp.com/email.php?hash='.$hash.'">Confirm</a>
</body>
</html>
';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";




mail($to, $subject, $message, $headers);


// Сообщение
/*$message = "Line 1\r\nLine 2\r\nLine 3";

// На случай если какая-то строка письма длиннее 70 символов мы используем wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Отправляем
mail($email, 'My Subject', $message);*/


}





function updata(){

    $conn = connect();
    $Name = $_POST['Name'];
    $pass = $_POST['pass'];
    $id = $_POST['id'];


    $sql = "UPDATE `User` SET `Name` = '$Name', `password` = '$pass' WHERE `User`.`ID` = '$id';";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    mysqli_close($conn);

}



function login(){
    $conn = connect();
    $email = $_POST['Email'];
    $pass = $_POST['pass'];


    $sql = "SELECT `ID` FROM `User` WHERE `password` = '$pass' and `Email` = '$email' and email_confirm = '1'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row["ID"];
        echo $id;
        echo json_encode($id);


    } else {
        $out = "false";
        echo "false";
        echo json_encode($out);
    }

    mysqli_close($conn);
}