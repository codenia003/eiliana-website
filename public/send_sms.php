<?php
/*error_reporting(E_ALL & ~E_NOTICE); //E_ALL & ~E_NOTICE
ini_set('display_errors', 1);
ini_set('display_startup_errors', 0);
error_reporting(1);
*/

$mobile_otp = '1234';

$to = "91".$_GET['mobile'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.kaleyra.io/v1/HXAP1693485091IN/messages');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'to='.$to.'&type=OTP&sender=ILIANA&body='.$mobile_otp.' is your OTP from eiliana.com&template_id=1007162097562737258');

$headers = array();
$headers[] = 'Api-Key: A1ffb94833d64ffd5d5a68e99318b0b25';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$json_response = curl_exec($ch);

$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ( $status != 201 ) {
    die("response $json_response, curl_error " . curl_error($ch) . ", curl_errno " . curl_errno($ch));
}
curl_close($ch);

