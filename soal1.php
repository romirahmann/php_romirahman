<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test PHP</title>
    <style>
        .input-container {
            padding: 20px;
            margin: 20px auto;
            max-width: 100%;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .input-row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .input-row label {
            font-weight: bold;
        }

        .input-row input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="input-container">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rows = intval($_POST["rows"]);
        $cols = intval($_POST["cols"]);

        if (isset($_POST["inputs"])) {
            $inputs = $_POST["inputs"];
          
            foreach ($inputs as $key => $value) {
                echo htmlspecialchars($key) . " : " . htmlspecialchars($value) . "<br>";
            }
        } else {
            echo "<form method='post'>";
            echo "<input type='hidden' name='rows' value='$rows'>";
            echo "<input type='hidden' name='cols' value='$cols'>";

            for ($i = 1; $i <= $rows; $i++) {
                echo "<div class='input-row' style='flex-direction:" . ($rows == 1 ? "row" : "column") . "'>";
                for ($j = 1; $j <= $cols; $j++) {
                    echo "<label>Kolom $i.$j:</label> <input type='text' name='inputs[$i.$j]' required>";
                }
                echo "</div>";
            }
            echo "<button type='submit'>Submit</button>";
            echo "</form>";
        }
    } else {
        ?>
        <form method="post">
            <label>Jumlah Baris: </label>
            <input type="number" name="rows" min="1" required><br>
            <label>Jumlah Kolom: </label>
            <input type="number" name="cols" min="1" required><br>
            <button type="submit">Submit</button>
        </form>
        <?php
    }
    ?>
</div>

</body>
</html>
