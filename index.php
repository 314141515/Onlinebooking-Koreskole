<?php
$servername = "mysql40.unoeuro.com";
$username = "campuskoreskole_dk";
$password = "db2pDhmB5akwc4nH3Fyx";
$dbname = "campuskoreskole_dk_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Forbindelse mislykkedes: " . $conn->connect_error);
}

$sql = "SELECT KorselNavn, KorselsTid, KorselsPris FROM korsel";
$result = $conn->query($sql);

$sql_ekstra = "SELECT KorseEkstraNavn, KorseEkstraTid, KorseEkstraPris FROM koreselekstra";
$result_ekstra = $conn->query($sql_ekstra);
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Booking - Vælg en pakke</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

<h2 class="text-center">Vælg Din Kørelektion</h2>

<form id="package-form" method="POST" action="selection.php">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Lektion</th>
            <th>Kørselstid</th>
            <th>Pris</th>
            <th>Vælg</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $uniqueId = uniqid('package_');
                echo "<tr>";
                echo "<td>" . ($row["KorselNavn"]) . "</td>";
                echo "<td>" . ($row["KorselsTid"]) . "</td>";
                echo "<td>" . ($row["KorselsPris"]) . " kr.</td>";
                echo "<td><input type='radio' name='packages' value='" . ($row["KorselNavn"]) . "' data-price='" . ($row["KorselsPris"]) . "' id='$uniqueId' class='form-check-input package-radio'>";
                echo "<label class='form-check-label' for='$uniqueId'>Vælg</label></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>Ingen data fundet</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <h3 class="mt-5">Ekstra Kørelektion</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Ekstra Lektion</th>
            <th>Tid</th>
            <th>Pris</th>
            <th>Vælg</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result_ekstra->num_rows > 0) {
            while($row_ekstra = $result_ekstra->fetch_assoc()) {
                $uniqueEkstraId = uniqid('extra_');
                echo "<tr>";
                echo "<td>" . ($row_ekstra["KorseEkstraNavn"]) . "</td>";
                echo "<td>" . ($row_ekstra["KorseEkstraTid"]) . "</td>";
                echo "<td>" . ($row_ekstra["KorseEkstraPris"]) . " kr.</td>";
                echo "<td><input type='radio' name='extras[]' value='" . ($row_ekstra["KorseEkstraNavn"]) . "' data-price='" . ($row_ekstra["KorseEkstraPris"]) . "' id='$uniqueEkstraId' class='form-check-input extra-radio'>";
                echo "<label class='form-check-label' for='$uniqueEkstraId'>Vælg</label></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>Ingen ekstra data fundet</td></tr>";
        }
        ?>
        </tbody>
    </table>
</form>

<form action="selection.php" method="post" id="continue-form">
    <h3>Samlet pris: <span id="total-price">0</span> kr.</h3>
    <button type="submit" class="btn btn-primary btn-block" id="continue-button">Videre</button>
</form>


<!-- Vi har fået hjælp via AI -->
<script>
    document.addEventListener('DOMContentLoaded', function (){
        function calculateTotalPrice (){
            let totalPrice = 0;

            const checkedPackage = document.querySelector('.package-radio:checked');
            if (checkedPackage) {
                totalPrice += parseFloat(checkedPackage.dataset.price);
            }

            const checkedExtras = document.querySelectorAll('.extra-radio:checked');
            checkedExtras.forEach(function (extra){
                totalPrice += parseFloat(extra.dataset.price);
            });

            document.getElementById('total-price').textContent = totalPrice.toFixed(2);
        }

        calculateTotalPrice();

        document.querySelectorAll('.package-radio, .extra-radio').forEach(function (input){
            input.addEventListener('change', function (){
                calculateTotalPrice();
            });
        });

        document.getElementById('continue-button').addEventListener('click', function (e) {
            if (!document.querySelector('.package-radio:checked')) {
                e.preventDefault();
                alert("Vær venlig at vælge en pakke før du går videre.");
            }
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>