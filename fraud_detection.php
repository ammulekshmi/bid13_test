<?php
/**
 * Developer Doc: https://developer.telesign.com/enterprise/reference/submitphonenumberforidentity
 */
function isValidPhoneNumber($phone_number, $customer_id, $api_key) {
    $api_url = "https://rest-ww.telesign.com/v1/phoneid/$phone_number";

    // Payload added as per documentation to provide consent (Fix: Missing payload caused request issues)
    $payload = json_encode(array(
        'consent' => array(
            "method" => 1
        ),
    ));

    // Headers updated with correct content type and authorization (Fix: Content-Type should be JSON)
    $headers = [
        "Authorization: Basic " . base64_encode("$customer_id:$api_key"), // Fix: Using basic auth for Telesign API
        "Content-Type: application/json",
        'Content-Length: ' . strlen($payload) // Fix: Ensuring correct content length
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Fix: Disabling SSL verification for testing (remove in production)
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Fix: Handling API authentication or access failure
    if ($http_code === 401) {
        error_log(print_r("Telesign API error: Unauthorized access. Check API key and account permissions."));
        return false;
    }
    
    if ($http_code !== 200) {
        return false; // API request failed
    }

    $data = json_decode($response, true);

    // Fix: Ensuring response contains expected data structure
    if (!isset($data['numbering']['phone_type'])) {
        error_log(print_r("Telesign API response does not contain 'phone_type'. Check API response format."));
        return false;
    }

    // Fix: Updated phone type validation with proper uppercase comparison
    $valid_types = ["FIXED_LINE", "MOBILE", "VALID"];
    return in_array(strtoupper($data['numbering']['phone_type']), $valid_types);
}


// Usage example
$phone_number = "1234567890"; // Replace with actual phone number
$customer_id = "your_customer_id"; // Replace with your actual Telesign customer ID
$api_key = "your_api_key"; // Replace with your actual API key

$result = isValidPhoneNumber($phone_number, $customer_id, $api_key);
echo '</br>Final Response: ';var_dump($result);
