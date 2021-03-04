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


        // upload gambar
        $gambar = upload();
        if (!$gambar) {
            return false;
        }



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

function upload()
{
    //* ambil dulu beberapa data di $_FILES
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //? check apakah tidak ada gambar yg diupload
    if ($error === 4) {
        echo "<script>
            alert('Upload gambar terlebih dahulu!!');
        </script>";

        return false;
    }

    //? Check apakah yg diupload itu gambar?
    //* jadi kita ambil ekstensi gambar yg didalam database lalu kita valid kan dengan ekstensi gambar yang sudah kita siapkan sendiiri.

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png']; //* Pilih format yg valid
    $ekstensiGambar = explode('.', $namaFile); //* Pecahkan formatfile menjadi array
    $ekstensiGambar = strtolower(end($ekstensiGambar)); //* Ambil data yg paling akhir alias array yg berisi format filennya

    //* check apakah ekstensi gambar sesuai dengan ekstensigambarvalid
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
            alert('Masukan gambar berformat JPEG,PNG,JPG');
            
        </script>";
        return false;
    }

    //? Check apakah ukurannya terlalu besar!?
    if ($ukuranFile > 1000000) {
        echo "<script>
            alert('Ukuran terlalu besar!');
        </script>";

        return false;
    }

    //? ketika ternyata gambar memiliki nama file yg sama
    //* Generate Gambar baru;
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    //* Memindahkan file kedalam directory kita
    move_uploaded_file($tmpName, 'img/' . $namaFile);

    return $namaFile;
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
    $gambarLama = htmlspecialchars($data['gambarLama']);

    //? check apakah user memilih untuk upload gambar baru atau tidak?
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }




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


//* Fungsi Cari data mahasiswa
function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa
            WHERE
            nama LIKE '%$keyword%' OR 
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
    ";

    return query($query);
}
