<?php
// 1. Koneksi Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_kontak";

$kon = mysqli_connect($host, $user, $pass, $db);

if (!$kon) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 2. Ambil data dari form (Gunakan operator ?? untuk menghindari error undefined)
$nama    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// 3. Masukkan ke tabel 'pesan'
if (!empty($nama)) {
    $sql = "INSERT INTO pesan (nama, email, subjek, pesan) VALUES ('$nama', '$email', '$subject', '$message')";
    
    if (mysqli_query($kon, $sql)) {
        echo "<h1>Berhasil!</h1>";
        echo "<p>Data sudah masuk ke database.</p>";
        echo "<a href='index.html'>Kembali ke Form</a>";
    } else {
        echo "Error: " . mysqli_error($kon);
    }
} else {
    echo "Data nama kosong!";
}
?>