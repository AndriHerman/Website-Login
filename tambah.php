<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

if (isset($_POST["submit"])) {

    // var_dump($_POST);
    // var_dump($_FILES);die;

    if (tambah($_POST) > 0) {
        echo "
        <script>
        alert('Data Berhasil di Tambahkan');
        document.location.href='index.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data Gagal di Tambahkan');
        document.location.href='index.php';
        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f3f3f3;
        margin: 0;
    }

    h1 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        text-align: center;
        margin: 20px 0;
    }

    form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
    }

    td {
        padding: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }

    input[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #27ae60;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    /* Additional styling for select input */
    select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }
</style>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h1>Tambah Data Mahasiswa</h1>

        <table>
            <tr>
                <td width="130">Nim</td>
                <td><input type="text" name="nim" required></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>
                    <select name="jurusan" required>
                        <option value="Pilih Jurusan" </option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Management Informatika">Management Informatika</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td><input type="file" name="gambar" id="gambar"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Simpan" name="submit"></td>
            </tr>
        </table>
    </form>
</body>

</html>