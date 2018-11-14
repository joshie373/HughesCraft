<!DOCTYPE html>
<html>
<head>
<?php include "linkRefs.php"; ?>
</head>
<?php 
include "header.php";
?>
<body>
<?php 

//-----get access token----------------
$getAccess = curl_init(); 
//step2
curl_setopt($getAccess, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($getAccess, CURLOPT_RETURNTRANSFER, true);
curl_setopt($getAccess, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($getAccess, CURLOPT_POST, true);
curl_setopt($getAccess, CURLOPT_USERPWD, "AXqR6ndlao96ldVT2FtLEWytRnCgacIAn28YYeW_pZfNyqP28qZDD8hG4YnrgmkyhFzCASkCUwCsddux" . ":" . "EAbO3Nv41mJ-ZrnR0ORdS7djRVTX0VVx-wi1SBMV6h1MVm8cMYABzkxM5cAyTjyjmeDKqFWGi3BqMznI");
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


$paymentID = $_REQUEST["paymentid"];
//------get payment details---------------
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment/".$paymentID."");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
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
$resultParse = json_decode($result,true);
//---------end get payment details------


//-----------add user and order to database---
require "dbconn.php";
//------------add user from Express checkout----
$fName    = $resultParse['payer']['payer_info']['first_name'];
$lName    = $resultParse['payer']['payer_info']['last_name'];
$street    = $resultParse['payer']['payer_info']['shipping_address']['line1'];
$city    = $resultParse['payer']['payer_info']['shipping_address']['city'];
$state    = $resultParse['payer']['payer_info']['shipping_address']['state'];
$zip    = $resultParse['payer']['payer_info']['shipping_address']['postal_code'];
$email    = $resultParse['payer']['payer_info']['email'];
$phone    = $resultParse['payer']['payer_info']['phone'];

$query   = "INSERT into customers (fName,LName,street,city,state,zip,cu_email,phone) VALUES(
'" . $fName . "',
'" . $lName . "',
'" . $street . "',
'" . $city . "',
'" . $state . "',
'" . $zip . "',
'" . $email . "',
'" . $phone . "'
)";
$success = $conn->query($query);
 
if (!$success) {
    die("Couldn't enter data: ".$conn->error);
}
 else {
    $last_customerID = $conn->insert_id;
 }
 $cust    = $last_customerID;
 //---------end insert customer-----------------

 //------------------insert order into DB--------
 $amount    = $resultParse['transactions'][0]['related_resources'][0]['sale']['amount']['total'];
 $status    = $resultParse['transactions'][0]['related_resources'][0]['sale']['state'];
 $transaction = $resultParse['transactions'][0]['related_resources'][0]['sale']['id'];
 
 $query   = "INSERT into orders (customer_id,amount,status,transactionID) VALUES(
 '" . $cust . "',
 '" . $amount . "',
 '" . $status . "',
 '" . $transaction . "'
 
 )";
 $success = $conn->query($query);
  
 if (!$success) {
     die("Couldn't enter data: ".$conn->error);
 }
  else {
     $last_orderID = $conn->insert_id;
     
  }
//-------end insert oder into db--------------

$conn->close();


//---------------end add user/order-----------


//-----build results table------------------
echo "
<h1 class='text-center'>Thank you for your payment ".$resultParse['payer']['payer_info']['first_name']."!</h1>
<h3 class='text-center'>Order ".$last_orderID." Details:</h3>
<h4 class='text-center'><b>Payment Status: </b>".$resultParse['transactions'][0]['related_resources'][0]['sale']['state']."   <b>Transaction ID: </b>".$resultParse['transactions'][0]['related_resources'][0]['sale']['id']." </h4>
<br>
<br>
<div style='margin:auto;width: 60%'>
<table class='table-striped' style='margin:auto;width: 100%'>
<tr class='text-center'>
    <th class='text-center'>Title</th>
    <th class='text-center'>Product ID</th>
    <th class='text-center'>Description</th>
    <th class='text-center'>Price</th>
    <th class='text-center'>  Currency  </th>
    <th class='text-center'>Quantity</th>
</tr>";
$resultsItems = $resultParse['transactions'][0]['item_list']['items'];
foreach ($resultsItems as $resultsItem) {
    echo "<tr class='text-center'>";
    foreach($resultsItem as $key => $value){
        echo "<td>".$value."</td>";
    }
    echo "</tr>";
}
echo "
</table>
";
echo "
<table class='table-bordered pull-right'>
";
$resultsDetails = $resultParse['transactions'][0]['related_resources'][0]['sale']['amount']['details'];
foreach($resultsDetails as $key => $value){
    echo "<tr><td><b>".$key.":</b></td><td>".$value."</td></tr>";
}
echo "
<hr>
<tr>
    <td><b>Total:</b></td><td><b>".$resultParse['transactions'][0]['related_resources'][0]['sale']['amount']['total']."</b></td>
</tr>
</table>
</div>
";
//-----------------end table build------------



// echo $result;

?>
<script>
resetcart();
</script>
</body>
</html>