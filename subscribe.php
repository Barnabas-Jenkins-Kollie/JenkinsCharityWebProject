<?php
require_once "./connection/mysqli_connection.php";
// session_start();
// if (isset($_SESSION["name"])) {
//     header("Location: index.php");
// }

//registering the user into database

if (isset($_POST["submit"])) {
    $email = ($_POST["subscribe_email"]);
    $erros = array();


    $url = 'index.php';

    if (empty($email)) {
        array_push($erros, "field is empty. ");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($erros, "invalid email. ");
    }


    // search if email already exist

    $sql_email = "SELECT * FROM SUBSCRIBER WHERE email ='$email'";
    $result = mysqli_query($DBcon, $sql_email);
    if (mysqli_num_rows($result) > 0) {
        array_push($erros, "email already exist");
    }

    if (count($erros) > 0) {
        foreach ($erros as $error) {
            echo "<script>alert('$error')</script>";
            echo "<script>location.href ='$url'</script>";

        }

    } else {
        $sql = "INSERT INTO SUBSCRIBER(email ) VALUES( ?)";
        $stmt = mysqli_stmt_init($DBcon);
        $prepare_stmt = mysqli_stmt_prepare($stmt, $sql);

        if ($prepare_stmt) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            echo "<script>alert('Thanks for Subscribing.')</script>";
        } else {
            echo "<script>alert('Sytem busy try again')</script>";
        }
    }
}

