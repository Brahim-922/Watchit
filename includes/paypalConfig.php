<?php
require_once("PayPal-PHP-SDK/autoload.php");



$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'ARjzSDlBr4w2fEGir5YwWiuWlmOtAeDHABiWUj7vZjJQQ0nbHIwh4cep6XX3f-R__I2Kj_DEqpoPdhHL',     // ClientID
        'EGNgOI4KvLjPDI_J1Z4uH1IQR4O-s5A-XkR35f0rdG4T9mTayFLyEMoJFwZ1MxDz2Mi0BbISCYFrkh0m'      // ClientSecret
    )
);

?>