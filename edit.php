<?php
//* Connect database dulu
require 'functions.php';

//* ambil data dari link
$idmhs = $_GET['id'];

//? kenapa isi [0] di akhir query?
//* karena saat menampilkan data, masih memberikan kotak. maka dari itu harus dikeluarkan dulu.
$siswa = query("SELECT * FROM mahasiswa WHERE id = $idmhs")[0];


//? Check apakah tombol "Submit" sudah ditekan atau belum?
if (isset($_POST["submit"])) {

    if (ubah($_POST) > 0) {
        echo "<script>
            alert('data berhasil diedit!!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('data gagal! diedit!!');
            document.location.href = 'index.php';
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit data siswa</title>
</head>

<body>
    <h1>Edit Data Mahasiswa</h1>
    <a href="index.php">kembali</a>
    <br><br>

    <form action="" method="post">
        <ul>
            <li>
                <label for="nrp">NRP :</label>
                <!-- data tidak terlihat -->
                <input type="hidden" name="id" value="<?= $siswa['id']; ?>">
                <input type="text" name="nrp" id="nrp" required value="<?= $siswa['nrp']; ?>">
            </li>

            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required value="<?= $siswa['nama']; ?>">
            </li>

            <li>
                <label for="email">email :</label>
                <input type="text" name="email" id="email" required value="<?= $siswa['email']; ?>">
            </li>

            <li>
                <label for="jurusan">jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $siswa['jurusan']; ?>">
            </li>

            <li>
                <label for="gambar">gambar :</label>
                <input type="text" name="gambar" id="gambar" value="<?= $siswa['gambar']; ?>">
            </li>

            <li>
                <button type="submit" name="submit">Edit Data</button>
            </li>
        </ul>
    </form>
</body>

</html>