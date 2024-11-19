<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help / FAQ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css-stylesheet-bootstrap.css">
</head>
<body class="help-background help-page">
<?php include('header.php'); ?>
<main class="container mt-5">
    <div class="faq-container">
        <div class="question-box" data-bs-toggle="modal" data-bs-target="#modal1">
            <h3>How can I reserve a room?</h3>
        </div>
        <div class="question-box" data-bs-toggle="modal" data-bs-target="#modal2">
            <h3>How can I cancel my reservation?</h3>
        </div>
        <div class="question-box" data-bs-toggle="modal" data-bs-target="#modal3">
            <h3>Which payment methods are accepted?</h3>
        </div>
        <div class="question-box" data-bs-toggle="modal" data-bs-target="#modal4">
            <h3>How can I contact customer service?</h3>
        </div>
        <div class="question-box" data-bs-toggle="modal" data-bs-target="#modal5">
            <h3>Is there parking?</h3>
        </div>
    </div>
</main>

<!-- Modale Fenster für Antworten -->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel1">How can I reserve a room?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                To reserve a room, you must register and log in on our website. You can then check availability and make a booking under “Reserve a room”.
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel2">How can I cancel my reservation?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Once you are logged in, you can manage and cancel your reservations under "My Reservations".
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modalLabel3" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel3">Which payment methods are accepted?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                We accept payments by credit card and PayPal. More payment methods will be added soon.
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="modalLabel4" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel4">How can I contact customer service?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You can reach us by email at support@gd-hotel.at or call us by phone at +43 (0)1 234 56789.
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal5" tabindex="-1" aria-labelledby="modalLabel5" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel5">Is there parking?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Yes, you can optionally book a parking space when booking.
            </div>
        </div>
    </div>
</div>


    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php include('footer.php'); ?>
</body>
</html>
