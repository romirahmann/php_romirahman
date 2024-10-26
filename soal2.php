<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Jumlah Orang per Hobi</title>
    <style>
        .container {
            text-align: center;
        }
        /* Style tabel */
        table {
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Laporan Jumlah Orang per Hobi</h2>
<div class="container">
    <div class="search-container">
    <form method="post">
        <input type="text" name="search_hobi" placeholder="Cari hobi..." required>
        <button type="submit">Cari</button>
    </form>
</div>
<table>
    <tr>
        <th>Hobi</th>
        <th>Jumlah Orang</th>
    </tr>
    <?php
 
    $conn = new mysqli("localhost", "root", "", "testdb");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["search_hobi"])) {
        $search_hobi = $conn->real_escape_string(trim($_POST["search_hobi"]));

        $sql = "SELECT hobi.hobi, COUNT(person.id) AS jumlah_orang
                FROM hobi
                JOIN person ON hobi.person_id = person.id
                WHERE hobi.hobi LIKE '%$search_hobi%'
                GROUP BY hobi.hobi
                ORDER BY jumlah_orang DESC";
    } else {
        $sql = "SELECT hobi.hobi, COUNT(person.id) AS jumlah_orang
                FROM hobi
                JOIN person ON hobi.person_id = person.id
                GROUP BY hobi.hobi
                ORDER BY jumlah_orang DESC";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row["hobi"]) . "</td><td>" . htmlspecialchars($row["jumlah_orang"]) . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>Tidak ada data</td></tr>";
    }

    $conn->close();
    ?>
</table>
</div>


</body>
</html>
