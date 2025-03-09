<?php
$url = "https://api.phonepe.com/payments";
$data = json_encode([
    "merchantId" => "1235",
    "transactionId" => "1",
    "amount" => "10000",  // Amount in paise (100.00 INR)
    "currency" => "INR",
    "callbackUrl" => "http://yourwebsite.com/payment-success"
]);

$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "X-VERIFY: YOUR_SIGNATURE",
    "X-MERCHANT-ID: YOUR_MERCHANT_ID"
]);

$response = curl_exec($ch);
if ($response === false) {
    echo "cURL Error: " . curl_error($ch);
} else {
    echo "Response: " . $response;
}

curl_close($ch);
?>
<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/data.txt"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>