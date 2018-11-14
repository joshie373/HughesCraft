<?php 

//------------gets contents of JSON builder--------
require "../PPExpressBuilder.php";
ob_start();
   buildTransactions();
   $paypalPost = ob_get_contents();
ob_end_clean();
//----------end get json content-------------------

//-----get access token----------------------------
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");//Sandbox
//curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/oauth2/token");//live
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_USERPWD, "AXqR6ndlao96ldVT2FtLEWytRnCgacIAn28YYeW_pZfNyqP28qZDD8hG4YnrgmkyhFzCASkCUwCsddux" . ":" . "EAbO3Nv41mJ-ZrnR0ORdS7djRVTX0VVx-wi1SBMV6h1MVm8cMYABzkxM5cAyTjyjmeDKqFWGi3BqMznI");//sandbox
//curl_setopt($ch, CURLOPT_USERPWD, "AQv6Orab_dMSvdPfsGHgegtPRei7vxi9NgUyFx6HwP77xXmxS7NRIifpQhQGhrGDLM9qHJ186XcWGbm0" . ":" . "EGf6-yY3VNlWqwF2jVqow49E32Eis4x1qsqS5mxkrcmBRb8Vm5PeotmQ2ZphoJiNx96-KEdzavAR9pve");//live
curl_setopt($ch, CURLOPT_VERBOSE, true); 
$headers = array();
$headers[] = "Accept: application/json";
$headers[] = "Accept-Language: en_US";
$headers[] = "Content-Type: application/x-www-form-urlencoded";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_VERBOSE, true); 
$result1=curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$result1 = json_decode($result1,true);
$accessToken = $result1["access_token"];
//-----------------------end access token---------

//----------send payment--------------------------
$cSession = curl_init();

curl_setopt($cSession, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment");//sandbox
//curl_setopt($cSession, CURLOPT_URL, "https://api.paypal.com/v1/payments/payment");//live
curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cSession,CURLOPT_POSTFIELDS, $paypalPost);
curl_setopt($cSession, CURLOPT_POST, true);
curl_setopt($cSession, CURLOPT_VERBOSE, true); 
$headers = array();
$headers[] = "Content-Type: application/json";
$headers[] = "Authorization: Bearer ".$accessToken."";
curl_setopt($cSession, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($cSession);
if (curl_errno($cSession)) {
    echo 'Error:' . curl_error($cSession);
}
curl_close ($cSession);
echo $result;
//------------end send pamynet--------------------
?>


