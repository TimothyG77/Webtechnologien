<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help / FAQ</title>
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


    

   <?php include('footer.php'); ?>
  
</body>
</html>
