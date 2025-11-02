<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "latihan_8";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, "", $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM data_kecamatan_1";
    $result = $conn->query($sql);

    echo "<a href='input/index.html'>Input</a>";

    if ($result->num_rows > 0) {
        echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nama Kecamatan</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Luas</th>
            <th>Jumlah Penduduk</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['kecamatan'] . "</td>
                <td>" . $row['longitude'] . "</td>
                <td>" . $row['latitude'] . "</td>
                <td>" . $row['luas'] . "</td>
                <td>" . $row['jumlah_penduduk'] . "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "0 hasil";
    }

    $conn->close();
    ?>
</body>

</html>