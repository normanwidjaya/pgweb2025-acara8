<!DOCTYPE html>
<html lang="en">

<body>

    <h2>Form Edit</h2>

    <?php
    // Setting koneksi
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "latihan_8";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Pastikan parameter id ada
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM data_kecamatan_1 WHERE id = $id";
        $result = $conn->query($sql);
    } else {
        die("Error: ID parameter is missing in the URL.");
    }

    // Tampilkan form jika data ditemukan
    if ($result && $result->num_rows > 0) {
        echo "<form action='edit.php' onsubmit='return validateForm()' method='post'>";
        while ($row = $result->fetch_assoc()) {
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'><br>";
            echo "<label for='kecamatan'>Kecamatan:</label><br>";
            echo "<input type='text' id='kec' name='kecamatan' value='" . $row['kecamatan'] . "'><br>";

            echo "<label for='longitude'>Longitude:</label><br>";
            echo "<input type='text' id='long' name='longitude' value='" . $row['longitude'] . "'><br>";

            echo "<label for='latitude'>Latitude:</label><br>";
            echo "<input type='text' id='lat' name='latitude' value='" . $row['latitude'] . "'><br>";

            echo "<label for='luas'>Luas:</label><br>";
            echo "<input type='text' id='luas' name='luas' value='" . $row['luas'] . "'><br>";

            echo "<label for='jumlah_penduduk'>Jumlah Penduduk:</label><br>";
            echo "<input type='text' id='jml_pddk' name='jumlah_penduduk' value='" . $row['jumlah_penduduk'] . "'><br><br>";
        }
        echo "<input type='submit' value='Submit'>";
        echo "</form>";
    }
    $conn->close();
    ?>

    <p id="informasi"></p>

    <script>
        function validateForm() {
            let luas = document.getElementById("luas").value;
            let text = "";
            if (isNaN(luas) || luas < 1) {
                text = "Data luas harus angka dan tidak boleh bernilai negatif";
                event.preventDefault();
            }
            document.getElementById("informasi").innerHTML = text;
        }
    </script>

</body>

</html>