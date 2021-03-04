<?php

require "functions.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");

    //? CHECK username ada atau tidak?
    if (mysqli_num_rows($result) === 1) {

        //? Check apakah password sudah sesuai?
        //* ambil data dari database dulu
        $row = mysqli_fetch_assoc($result);
        //* Check sudah sesuai atau tidak
        if (password_verify($password, $row["password"])) {
            //* Langsung arahkan user ke halaman Index.php
            header("Location:index.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PHP</title>
</head>

<body>
    <h1>LOGIN</h1>

    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">username </label>
                <input type="text" name="username" id="username">
            </li>

            <li>
                <label for="password">password </label>
                <input type="password" name="password" id="password">
            </li>

            <li>
                <button type="submit" name="login">LOGIN</button>
            </li>
        </ul>
    </form>
</body>

</html>