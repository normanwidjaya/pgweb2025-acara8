<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web GIS Kecamatan Yogyakarta</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            margin: 0;
            background-color: #f4f4f9;
        }

        .container {
            display: flex;
            width: 100%;
        }

        #table-container {
            width: 50%;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #ddd;
        }

        #map-container {
            width: 50%;
            padding: 30px;
        }

        #map {
            height: 100%;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .btn {
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            display: inline-block;
            text-align: center;
        }

        .btn-input {
            background-color: #28a745;
            margin-bottom: 20px;
        }

        .btn-edit {
            background-color: #ffc107;
        }

        .btn-delete {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    <?php
    // Koneksi ke database
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

    // Ambil data untuk tabel
    $sql_table = "SELECT * FROM data_kecamatan_1";
    $result_table = $conn->query($sql_table);

    // Ambil data untuk peta
    $sql_map = "SELECT kecamatan, latitude, longitude FROM data_kecamatan_1";
    $result_map = $conn->query($sql_map);

    $locations = [];
    if ($result_map->num_rows > 0) {
        while ($row = $result_map->fetch_assoc()) {
            $locations[] = $row;
        }
    }

    ?>

    <div class="container">
        <div id="table-container">
            <h1>Web GIS Kecamatan Yogyakarta</h1>
            <?php
            echo "<a href='input/index.html' class='btn btn-input'>Input Data</a>";

            if ($result_table->num_rows > 0) {
                echo "<table><tr>
<th>Kecamatan</th>
<th>Longitude</th>
<th>Latitude</th>
<th>Luas</th>
<th>Jumlah Penduduk</th>
<th colspan='2'>Aksi</th></tr>";
                // output data of each row
                while ($row = $result_table->fetch_assoc()) {
                    echo "<tr><td>" . $row["kecamatan"] . "</td>" .
                        "<td>" . $row["longitude"] . "</td>" .
                        "<td>" . $row["latitude"] . "</td>" .
                        "<td>" . $row["luas"] . "</td>" .
                        "<td align='right'>" . number_format($row["jumlah_penduduk"]) . "</td>" .
                        "<td><a href=edit/index.php?id=" . $row["id"] . " class='btn btn-edit'>Edit</a></td>" .
                        "<td><a href=delete.php?id=" . $row["id"] . " class='btn btn-delete'>Hapus</a></td>" .
                        "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 hasil";
            }
            ?>
        </div>

        <div id="map-container">
            <div id="map"></div>
        </div>
    </div>

    <script>
        var map = L.map('map').setView([-7.7956, 110.3695], 11);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> Addie Mapper'
        }).addTo(map);

        var locations = <?php echo json_encode($locations); ?>;

        locations.forEach(function (location) {
            if (location.latitude && location.longitude) {
                var marker = L.marker([location.latitude, location.longitude]).addTo(map);
                marker.bindPopup("<b>" + location.kecamatan + "</b>");
            }
        });
    </script>

    <?php
    $conn->close();
    ?>
</body>

</html>