<?php
require_once 'config.php';

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'http://localhost:8080/api/carriers', 
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERPWD => API_KEY . ':',
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC
));

$response = curl_exec($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

if ($httpcode == 403) {
    echo "Acceso restringido correctamente.";
} else {
    echo "Error: se obtuvo código HTTP $httpcode.";
}
?>
