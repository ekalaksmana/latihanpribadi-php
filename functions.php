<?php

// *Koneksi ke Database
$connection = mysqli_connect("localhost", "root", "root", "phpdasar");


//* Query data
function query($query)
{
    global $connection;

    $result = mysqli_query($connection, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $connection;

    //? Check apakah tombol "Submit" sudah ditekan atau belum?
    if (isset($_POST["submit"])) {
        //* Ambil Data tiap yang ada didalam Form terlebih dahulu.
        $nrp = htmlspecialchars($data['nrp']);
        $nama = htmlspecialchars($data['nama']);
        $email = htmlspecialchars($data['email']);
        $jurusan = htmlspecialchars($data['jurusan']);
        $gambar = htmlspecialchars($data['gambar']);


        //* Kita query data kedalam database alias kita masukan kedalam database.
        $query = "INSERT INTO mahasiswa 
            VALUES
                (null,'$nrp','$nama','$email','$jurusan','$gambar')
            ";

        mysqli_query($connection, $query);

        //* Setelah berhasil kita akan mengembalikan sebuah angka kedalam. alias kita memberikan info apakah berhasil atau tidak!!
        return mysqli_affected_rows($connection);
    }
}

function ubah($data)
{
    global $connection;

    //* Ambil Data tiap yang ada didalam Form terlebih dahulu.
    $id = $data['id'];
    $nrp = htmlspecialchars($data['nrp']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar = htmlspecialchars($data['gambar']);


    //* Kita query data kedalam database alias kita masukan kedalam database.
    $query = "UPDATE mahasiswa SET
            nrp = '$nrp',
            nama = '$nama',
            email = '$email',
            jurusan = '$jurusan',
            gambar = '$gambar' WHERE id = $id";

    mysqli_query($connection, $query);

    //* Setelah berhasil kita akan mengembalikan sebuah angka kedalam. alias kita memberikan info apakah berhasil atau tidak!!
    return mysqli_affected_rows($connection);
}
