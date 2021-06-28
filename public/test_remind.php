<?php
$reminderSent = false; // Get this value from the db (true or false)
$expiryActioned = false; // Get this value from the db (true or false)
$expiringDate = strtotime('2021-07-04'); // Get this date from the db
$todayDate = time();
$reminderDate = strtotime("-7 days", $expiringDate);
if ($todayDate >= $reminderDate && $reminderSent == false) {
    echo 'Hi';
    // Send mail
    // Set flag $reminderSent in database to indicate reminder has been sent
} elseif ($todayDate >= $expiringDate && $expiryActioned == false) {
    echo 'Hello';
    // Do something
    // Set $expiryActioned in database to indicate the user has expired and something has been done about it
}
?>