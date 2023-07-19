<?php

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "kampus");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;

    // Ambil data dari tiap elemen dalam form
    $nim =  htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);

    // $gambar = htmlspecialchars($data["gambar"]);
    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // Masukkan data ke database
    $query = "INSERT INTO mahasiswa (nim, nama, jurusan, email, gambar) VALUES 
                ('$nim', '$nama', '$jurusan', '$email', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek upload gambar
    if ($error === 4) {
        echo "<script>
        alert('Silakan Upload File Gambar');
        </script>";
        return false;
    }

    // cek jenis file
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Yang Anda Upload Bukan Gambar');
        </script>";
        return false;
    }

    // cek jika ukuran terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('Ukuran File Terlalu Besar');
        </script>";
        return false;
    }

    // Gambar siap Di Upload
    move_uploaded_file($tmpName, 'img/' . $namaFile);
    return $namaFile;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;

    // Ambil data dari tiap elemen dalam form
    $id = $data["id"];
    $nim =  htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);

    // $gambar = htmlspecialchars($data["gambar"]);
    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // Masukkan data ke database
    $query = "UPDATE mahasiswa SET
        nim = '$nim',
        nama = '$nama',
        jurusan = '$jurusan',
        email = '$email',
        gambar = '$gambar'
        WHERE id = $id
        ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cariData($keyword)
{
    global $conn;

    $keyword = mysqli_real_escape_string($conn, $keyword);

    // query pencarian data
    $query = "SELECT * FROM mahasiswa
              WHERE nim LIKE '%$keyword%'
              OR nama LIKE '%$keyword%'
              OR jurusan LIKE '%$keyword%'
              OR email LIKE '%$keyword%'";

    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
            alert('Username Sudah Terdaftar');
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
            alert('Password Tidak Sesuai');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");

    return mysqli_affected_rows($conn);
}
