<?php
//* Menghubungkan File functions di page ini
require "functions.php";

$mahasiswa = query("SELECT * FROM mahasiswa");


// // *Query/ambil datanya dari database
// $result = mysqli_query($connection, "SELECT * FROM mahasiswa");

//! Cara check database error atau tidak
// if (!$result) {
//     echo mysqli_error($connection);
// }
//* Kita ambil data dari tablenya alias Fetch
// $mhs = mysqli_fetch_row($result);
//* while ($mhs = mysqli_fetch_assoc($result)) {
//*     var_dump($mhs);
//* }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>

    <style>
        .box {
            width: 50px;
            height: 50px;
            background-color: black;
        }
    </style>

</head>

<body>
    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah data</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>

        <?php
        $nomer = 1;
        foreach ($mahasiswa as $row) : ?>
            <tr>
                <td><?= $nomer; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> | <a href="hapus.php?id=<?= $row['id']; ?>">Delete</a>
                </td>
                <td>
                    <div class="box"></div>
                </td>
                <td><?= $row["nrp"]; ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= $row["jurusan"]; ?></td>
            </tr>
        <?php $nomer++;
        endforeach; ?>
    </table>
</body>

</html>