<?php

$servername = "mysql40.unoeuro.com";
$username = "campuskoreskole_dk";
$password = "db2pDhmB5akwc4nH3Fyx";
$dbname = "campuskoreskole_dk_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Forbindelse mislykkedes: " . $conn->connect_error);
}



$sql = "SELECT dato, tid FROM valgte_datoer";
$result = $conn->query($sql);

$optagede_tider = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $optagede_tider[] = $row['dato'] . ' ' . $row['tid'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vælg en dato og tid</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .time-slot {
            background-color: #28a745;
            color: white;
            padding: 15px;
            margin: 5px 0;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
        }

        .time-slot:hover {
            background-color: #218838;
        }

        .time-slot.selected {
            background-color: #155724;
        }

        .time-slot.disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Vælg en dato og tid</h2>

    <form id="bookingForm" method="post" action="confirm.php">
        <div class="mb-3">
            <label for="dato" class="form-label">Vælg en dato:</label>
            <input type="date" id="dato" name="dato" class="form-control" value="<?php echo date("Y-m-d") ?>" required>
        </div>

        <div class="mb-3">
            <label for="tid" class="form-label">Vælg et tidspunkt:</label>
            <div id="timeSlots">
                <?php
                $start = strtotime('07:00');
                $end = strtotime('20:00');

                while ($start <= $end) {
                    $time = date('H:i', $start);
                    echo '<div class="time-slot" id="time-' . $time . '" onclick="selectTime(\'' . $time . '\')">' . $time . '</div>';
                    $start = strtotime('+1 hour 30 minutes', $start);
                }
                ?>
            </div>
            <input type="hidden" name="tid" id="selectedTime" required>
        </div>

        <input type="hidden" name="confirm" id="confirmInput" value="">

        <button type="button" class="btn btn-primary" onclick="confirmBooking()">Vælg dato og tid</button>
    </form>


    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Bekræft din tid</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Er du sikker på, at du vil bekræfte din booking på <span id="selectedDate"></span> kl. <span id="selectedTimeDisplay"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuller</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Bekræft</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const optagedeTider = <?php echo json_encode($optagede_tider); ?>;

    function selectTime(time) {
        const selectedDate = document.getElementById('dato').value;
        const selectedDateTime = selectedDate + ' ' + time;

        if (optagedeTider.includes(selectedDateTime)) {
            alert("Denne tid er allerede optaget!");
            return;
        }

        const timeSlots = document.querySelectorAll('.time-slot');
        timeSlots.forEach(slot => slot.classList.remove('selected'));

        document.getElementById('selectedTime').value = time;
        document.getElementById('selectedTimeDisplay').textContent = time;
        event.currentTarget.classList.add('selected');
    }

    function confirmBooking() {
        document.getElementById('selectedDate').textContent = document.getElementById('dato').value;
        const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
        modal.show();
    }

    function submitForm() {
        document.getElementById('confirmInput').value = 'yes';
        document.getElementById('bookingForm').submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>