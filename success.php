<?php
require 'vendor/autoload.php'; // Include the PHP JWT library (firebase/php-jwt)

use \Firebase\JWT\JWT;

function generateJWT($payload, $secretKey, $expiresIn = '1h') {
    return JWT::encode($payload, $secretKey, 'HS256');
}

// Example payload and secret key
$payload = array('user_id' => 12345678, 'username' => 'akeel ahmad wani');
$secretKey = 'abcdef';

// Generate the JWT token
$jwtToken = generateJWT($payload, $secretKey);
echo "Generated JWT: $jwtToken";
?>
