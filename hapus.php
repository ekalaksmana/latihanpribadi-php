<?php
//* Koneksikan database
require 'functions.php';

//* ambil datanya terlebih dahulu!!
$id = $_GET['id'];

//* Query datanya 
$query = "DELETE from mahasiswa where id = '$id' ";
mysqli_query($connection, $query);

//? check apakah berhasil atau tidak?
if (mysqli_affected_rows($connection) > 0) {
    echo "<script>
            alert('data berhasil dihapus!!');
            document.location.href = 'index.php';
        </script>";
} else {
    echo "<script>
            alert('data gagal dihapus!!');
            document.location.href = 'index.php';
        </script>";
}
