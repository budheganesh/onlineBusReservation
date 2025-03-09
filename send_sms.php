<?php
// function sendSMS($phone, $message) {
//     $api_key = "OSREqPfpMQDYuKb3w8Va6rZJjAWU1FgN2GTy9ceziHolXC07snusB6y1WQJAijRaVgtTfCFOzKrN0SEm"; // Replace with your API Key
//     $sender_id = "TXTIND";  // Sender ID for transactional SMS
//     $route = "v3";  // SMS route
//     $number = $phone;  

//     $postData = array(
//         "route" => $route,
//         "sender_id" => $sender_id,
//         "message" => $message,
//         "language" => "english",
//         "numbers" => $number,
//     );

//     $ch = curl_init("https://www.fast2sms.com/dev/bulkV2");
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//         "authorization: $api_key",
//         "Content-Type: application/json"
//     ));

//     $response = curl_exec($ch);
//     curl_close($ch);
//     return json_decode($response, true);
// }

// // Example Usage (After successful booking)
// $phone = "7218987255"; // Customer's phone number
// $message = "Your Bus Reservation is confirmed. Booking ID: 12345. Thank you!";
// $response = sendSMS($phone, $message);

// if ($response['return']) {
//     echo "SMS Sent Successfully!";
// } else {
//     echo "SMS Sending Failed!";
// }
// echo "API Response:".$response;
?>
<?php
function sendSMS($phone, $message) {
    $api_key = "OSREqPfpMQDYuKb3w8Va6rZJjAWU1FgN2GTy9ceziHolXC07snusB6y1WQJAijRaVgtTfCFOzKrN0SEm";  // Replace with your API Key
    $postData = [
        "route" => "v3",
        "sender_id" => "TXTIND",
        "message" => $message,
        "language" => "english",
        "numbers" => $phone,
    ];

    $ch = curl_init("https://www.fast2sms.com/dev/bulkV2");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "authorization: $api_key",
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);
    
    // Decode response
    $responseData = json_decode($response, true);
    
    // Debugging: Print response to check structure
    var_dump($responseData);
    
    // Check if the response contains the 'return' key
    if (isset($responseData['return'])) {
        return $responseData['return'];  // Use isset() to avoid undefined key error
    } else {
        return "Error: API response did not contain the expected 'return' key.";
    }
}

// Example Usage
$phone = "7218987255"; 
$message = "Your Bus Reservation is confirmed. Booking ID: 12345. Thank you!";
$response = sendSMS($phone, $message);

echo "API Response: " . $response;
?>
