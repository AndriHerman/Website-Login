<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
// pemanggilan file functions.php
require 'functions.php';

// ambil data dari tabel mahasiswa / query
$mahasiswa = query("SELECT * FROM mahasiswa");

// Cek apakah tombol cari telah ditekan
if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $mahasiswa = cariData($keyword);
    $showHomeButton = true; // Menampilkan tombol "Home"
} else {
    $showHomeButton = false; // Tidak menampilkan tombol "Home"
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .logo {
            display: block;
            max-width: 200px;
            margin: 0 auto;
        }

        .daftar {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        .nav-list {
            list-style: none;
            display: flex;
        }

        .nav-list-item {
            margin-right: 20px;
        }

        .nav-list-item a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
        }

        .nav-list-item a:hover {
            background-color: #555;
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-input {
            padding: 5px;
            border: 1px solid #999;
            border-radius: 5px;
        }

        .search-button {
            background-color: #555;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
        }

        table {
            margin: 20px auto;
            width: 95%;
            font-family: arial;
            border-collapse: fixed;
            text-align: center;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }

        .update-link,
        .delete-link {
            display: inline-block;
            padding: 5px 10px;
            background-color: #27ae60;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .delete-link {
            background-color: #c0392b;
        }

        .update-link:hover,
        .delete-link:hover {
            background-color: #219652;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #777;
        }

        .footer a {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }

        h1 {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin: 20px 0;
        }

        /* ... Previous CSS styles ... */

        /* CSS for Update and Hapus buttons */
        .action-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-buttons a {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: bold;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .update-link {
            background-color: #219652;
        }

        .delete-link {
            background-color: #c0392b;
        }

        .action-buttons a:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="images/LOGO UPS.png" ; alt:"logo" class="logo">
        <h1 class="daftar">Daftar Mahasiswa Fakultas Sains & Teknologi</h1>
    </div>
    <nav>
        <ul class="nav-list">
            <?php if ($showHomeButton) : ?>
                <li class="nav-list-item"><a href="index.php">Home</a></li>
            <?php endif; ?>
            <li class="nav-list-item"><a href="tambah.php">Tambah Data Mahasiswa</a></li>
            <li class="nav-list-item"><a href="logout.php">Logout</a></li>
        </ul>
        <div class="search-container">
            <form class="search-form" action="" method="post">
                <input class="search-input" type="text" name="keyword" placeholder="Cari data mahasiswa...">
                <button class="search-button" type="submit" name="cari">Cari</button>
            </form>
        </div>
    </nav>

    <table border="2" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Email</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $mhs["nim"] ?></td>
                <td><?php echo $mhs["nama"] ?></td>
                <td><?php echo $mhs["jurusan"] ?></td>
                <td><?php echo $mhs["email"] ?></td>
                <td><img src="img/<?php echo $mhs["gambar"]; ?>" width="50" alt=""></td>
                <td class="action-buttons">

                    <a href="ubah.php?id=<?php echo $mhs["id"] ?>" class="update-link">Update</a>
                    <br>
                    <a href="hapus.php?id=<?php echo $mhs["id"] ?>" onclick="return confirm('Yakin ingin Menghapus Data?')" class="delete-link">Hapus</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>

</body>

</html>