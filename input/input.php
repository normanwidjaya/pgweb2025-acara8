<?php
// Ambil data dari form
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// Konfigurasi koneksi database MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan_8";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Query simpan data lengkap
$sql = "INSERT INTO data_kecamatan_1 (kecamatan, longitude, latitude, luas, jumlah_penduduk)
        VALUES ('$kecamatan', $longitude, $latitude, $luas, $jumlah_penduduk)";

// Menyimpan data dan memeriksa apakah berhasil
if ($conn->query($sql) === TRUE) {
    $message = "Rekord berhasil disimpan.";
} else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();

// Redirect ke halaman utama
header("Location: ../index.php");
exit;
?>
