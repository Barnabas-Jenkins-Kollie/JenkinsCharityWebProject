<?php
require_once "./connection/mysqli_connection.php";
// session_start();
// if (isset($_SESSION["name"])) {
//     header("Location: index.php");
// }

//registering the user into database

if (isset($_POST["submit"])) {
    $vname = ($_POST["v_name"]);
    $vemail = ($_POST["volunteer_email"]);
    $vsubject = ($_POST["volunteer_subject"]);
    $vcomment = ($_POST["volunteer_comment"]);
    $erros = array();

    if (empty($vname) || empty($vemail) || empty($vsubject) || empty($vcomment)) {
        array_push($erros, "all fields are empty. ");
    }
    if (!filter_var($vemail, FILTER_VALIDATE_EMAIL)) {
        array_push($erros, "invalid email. ");
    }


    //search if email already exist

    // $sql_email = "SELECT * FROM VOLUNTEERS WHERE vemail ='$vemail'";
    // $result = mysqli_query($DBcon, $sql_email);
    // if (mysqli_num_rows($result) > 0) {
    //     array_push($erros, "email already exist");
    // }

    if (count($erros) > 0) {
        foreach ($erros as $error) {
            echo $error;
        }

    } else {
        require_once "./connection/mysqli_connection.php";
        $sql = "INSERT INTO VOLUNTEERS(fullname, email, comments, vsubject) VALUES(?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($DBcon);
        $prepare_stmt = mysqli_stmt_prepare($stmt, $sql);

        if ($prepare_stmt) {
            mysqli_stmt_bind_param($stmt, 'ssss', $vname, $vemail, $vcomment, $vsubject);
            mysqli_stmt_execute($stmt);
            echo "<script>alert('Registration successful')</script>";


        } else {
            echo "<script>alert('Registration Error')</script>";
        }
    }
}

