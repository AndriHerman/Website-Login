<?php
// Pemanggilan file functions.php
require 'functions.php';

// Proses pencarian data
if (isset($_GET['nama'])) {
    $keyword = $_GET['keyword'];
    $mahasiswa = cariData($keyword);
} else {
    // Jika tidak ada keyword pencarian, kembalikan ke halaman sebelumnya
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Data Mahasiswa</title>
</head>

<body>
    <h1>Pencarian Data Mahasiswa</h1>
    <form action="cari.php" method="GET">
        <input type="text" name="keyword" placeholder="Masukkan keyword pencarian" value="<?= $keyword; ?>">
        <button type="submit">Cari</button>
    </form>
    <br>

    <?php if (count($mahasiswa) > 0) : ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Email</th>
                <th>Gambar</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($mahasiswa as $mhs) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $mhs["nim"]; ?></td>
                    <td><?= $mhs["nama"]; ?></td>
                    <td><?= $mhs["jurusan"]; ?></td>
                    <td><?= $mhs["email"]; ?></td>
                    <td><img src="img/<?= $mhs["gambar"]; ?>" width="50"></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>Data tidak ditemukan.</p>
    <?php endif; ?>
</body>

</html>