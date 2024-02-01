<?php
function generate_csrf_token(): string
{
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
    return $token;
}

function test_input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

function getCoordinates($ip): ?array
{
    // Build the API request URL
    $apiKey = IPINFO_API_KEY;
    $apiUrl = "https://ipinfo.io/{$ip}/json?token={$apiKey}";

    // Make the API request using cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if the request was successful
    if ($data && isset($data['loc'])) {
        // Split the coordinates into latitude and longitude
        list($latitude, $longitude) = explode(',', $data['loc']);
        return ['latitude' => $latitude, 'longitude' => $longitude];
    } else {
        // Handle the case where the request was not successful
        // E.g. IP address not found or bogon IP
        return null;
    }
}