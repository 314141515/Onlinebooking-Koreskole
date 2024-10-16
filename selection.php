<?php
$servername = "mysql40.unoeuro.com";
$username = "campuskoreskole_dk";
$password = "db2pDhmB5akwc4nH3Fyx";
$dbname = "campuskoreskole_dk_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Forbindelse mislykkedes: " . $conn->connect_error);
}

$sql = "SELECT * FROM korelerer";
$result = $conn->query($sql);
?>
    <!DOCTYPE html>
    <html lang="da">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vælg en Kørelærer</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

    <div class="container mt-5">
        <h2 class="text-center">Vælg en kørelærer</h2>

        <?php
        if ($result->num_rows > 0) {
            echo '<table class="table table-bordered table-striped">';
            echo '<thead class="table-light"><tr><th>Navn</th><th>Gear</th><th>Erfaring</th><th></th></tr></thead>';

            echo '<tbody>';
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["KoreLereNavn"] . '</td>';
                echo '<td>' . $row["Gear"] . '</td>';
                echo '<td>' . $row["Erfaring"] . ' år</td>';
                echo '<td><a href="dato.php?koerelaerer_id=' . $row["KoreLereId"] . '" class="btn btn-primary">Vælg denne kørelærer</a></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p class="alert alert-warning">Ingen kørelærere tilgængelige.</p>';
        }
        ?>
    </div>

    <div class="text-center mt-5">
        <form action="index.php" method="post">
            <button type="submit" class="btn btn-primary" id="tilbage-button">Tilbage</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>
    </html>

<?php
$conn->close();
?>