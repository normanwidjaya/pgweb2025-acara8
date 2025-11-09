<?php
// Ambil data dari form
$id = $_POST['id'];
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan_8";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update data
$sql = "UPDATE data_kecamatan_1 
        SET kecamatan='$kecamatan', 
            longitude='$longitude',
            latitude='$latitude',
            luas='$luas',
            jumlah_penduduk='$jumlah_penduduk' 
        WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: ../index.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>