<?php 
$paymentID = $_POST["paymentID"];
$payerID = $_POST["payerID"];

//-----get access token----------------
$getAccess = curl_init(); 
//step2
curl_setopt($getAccess, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");//sandbox
//curl_setopt($getAccess, CURLOPT_URL, "https://api.paypal.com/v1/oauth2/token");//live
curl_setopt($getAccess, CURLOPT_RETURNTRANSFER, true);
curl_setopt($getAccess, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($getAccess, CURLOPT_POST, true);
curl_setopt($getAccess, CURLOPT_USERPWD, "AXqR6ndlao96ldVT2FtLEWytRnCgacIAn28YYeW_pZfNyqP28qZDD8hG4YnrgmkyhFzCASkCUwCsddux" . ":" . "EAbO3Nv41mJ-ZrnR0ORdS7djRVTX0VVx-wi1SBMV6h1MVm8cMYABzkxM5cAyTjyjmeDKqFWGi3BqMznI");//sanbox
//curl_setopt($ch, CURLOPT_USERPWD, "AQv6Orab_dMSvdPfsGHgegtPRei7vxi9NgUyFx6HwP77xXmxS7NRIifpQhQGhrGDLM9qHJ186XcWGbm0" . ":" . "EGf6-yY3VNlWqwF2jVqow49E32Eis4x1qsqS5mxkrcmBRb8Vm5PeotmQ2ZphoJiNx96-KEdzavAR9pve");//live
curl_setopt($getAccess, CURLOPT_VERBOSE, true); 
$headers = array();
$headers[] = "Accept: application/json";
$headers[] = "Accept-Language: en_US";
$headers[] = "Content-Type: application/x-www-form-urlencoded";
curl_setopt($getAccess, CURLOPT_HTTPHEADER, $headers);
curl_setopt($getAccess, CURLOPT_VERBOSE, true); 
//step3
$result1=curl_exec($getAccess);
//step4
curl_close($getAccess);
//step5
$result1 = json_decode($result1,true);
$accessToken = $result1["access_token"];
//-----------------------end access token


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment/".$paymentID."/execute");//sandbox
// curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/payments/payment/".$paymentID."/execute");//live
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"payer_id\": \"".$payerID."\"\n}");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_VERBOSE, true); 

$headers = array();
$headers[] = "Content-Type: application/json";
$headers[] = "Authorization: Bearer ".$accessToken."";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
echo $result;

?>