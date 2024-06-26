<?php
require_once "./connection/mysqli_connection.php";
// session_start();
// if (isset($_SESSION["name"])) {
//     header("Location: index.php");
// }

//registering the user into database

if (isset($_POST["submit"])) {
    $fname = ($_POST["first_name"]);
    $lname = ($_POST["last_name"]);
    $email = ($_POST["email"]);
    $message = ($_POST["message"]);
    $erros = array();

    if (empty($fname) || empty($email) || empty($lname) || empty($message)) {
        array_push($erros, "all fields are empty. ");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($erros, "invalid email. ");
    }


    // search if email already exist

    $sql_email = "SELECT * FROM CONTACT WHERE email ='$email'";
    $result = mysqli_query($DBcon, $sql_email);
    if (mysqli_num_rows($result) > 0) {
        array_push($erros, "email already exist");
    }

    if (count($erros) > 0) {
        foreach ($erros as $error) {
            echo "<div alert alert-danger>$error</div>";
        }

    } else {
        $sql = "INSERT INTO CONTACT(fname, lname, email, message) VALUES(?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($DBcon);
        $prepare_stmt = mysqli_stmt_prepare($stmt, $sql);

        if ($prepare_stmt) {
            mysqli_stmt_bind_param($stmt, 'ssss', $fname, $lname, $email, $message);
            mysqli_stmt_execute($stmt);
            echo "<script>alert('Message sent successfully')</script>";
        } else {
            echo "<script>alert('Sytem busy try again')</scri>";
        }
    }
}

