<?php
$id = $_GET['id'];

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan_8";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menghapus data berdasarkan ID
$sql = "DELETE FROM data_kecamatan_1 WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Data dengan ID $id berhasil dihapus.";
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

$conn->close();

// Kembali ke halaman utama
header("Location: index.php");
exit();
?>