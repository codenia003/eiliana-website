<?php
$reminderSent = false; 
$expiryActioned = false; 
$expiringDate = strtotime('2021-07-06'); 
$todayDate = time();
$reminderDate = strtotime("-7 days", $expiringDate);
if ($todayDate >= $reminderDate && $reminderSent == false) {
    echo 'Hi';
} elseif ($todayDate >= $expiringDate && $expiryActioned == false) {
    echo 'Hello';
}
else
{
    echo 'Hey';
}
?>