<?php

require "functions.php";

if (isset($_POST['register'])) {
    if (register($_POST) > 0) {
        echo "<script>
                alert('Users baru berhasil ditambahkan!');
            </script>";
    } else {
        echo mysqli_error($connection);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi form</title>
</head>

<body>
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username </label>
                <input type="text" name="username" id="username">
            </li>

            <li>
                <label for="password">password </label>
                <input type="text" name="password" id="password">
            </li>
            <!-- Confirmasi password -->
            <li>
                <label for="password2">confirm password </label>
                <input type="text" name="password2" id="password2">
            </li>

            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>
    </form>
</body>

</html>