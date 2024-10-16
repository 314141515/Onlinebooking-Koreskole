<?php
$servername = "mysql40.unoeuro.com";
$username = "campuskoreskole_dk";
$password = "db2pDhmB5akwc4nH3Fyx";
$dbname = "campuskoreskole_dk_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Forbindelse mislykkedes: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dato = $_POST['dato'];
    $tid = $_POST['tid'];
    $brugernavn = "Brugernavn";

    if (empty($tid)) {
        $message = "Fejl: Du skal vælge et tidspunkt.";
    } else {

        $check_sql = "SELECT * FROM valgte_datoer WHERE dato = ? AND tid = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("ss", $dato, $tid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Fejl: Den valgte dato og tid er allerede optaget.";
        } else {

            $sql = "INSERT INTO valgte_datoer (dato, tid, brugernavn) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $dato, $tid, $brugernavn);

            if ($stmt->execute()) {
                $message = "Booking bekræftet!";
            } else {
                $message = "Der opstod en fejl: " . $stmt->error;
            }
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Bekræftelse</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Booking Bekræftelse</h2>
    <p><?php echo isset($message) ? $message : ''; ?></p>
    <a href="dato.php" class="btn btn-primary">Vælg En Anden Tid</a>
    <a href="index.php" class="btn btn-primary">Hjem</a>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>