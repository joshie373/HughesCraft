<?php
include "header.php";
include "linkRefs.php";
//-----function to retrieve details from DB items___
$checkoutCustomerID = $_POST["checkoutFormCustId"];
  include "dbconn.php";
  $sql = "SELECT * FROM customers WHERE customerID=".$checkoutCustomerID."";
  $results = $conn->query($sql);
  $ResultVar = mysqli_fetch_assoc($results);

  $fName    =  $ResultVar['fName'];
  $lName    = $ResultVar['LName'];
  $street    = $ResultVar['street'];
  $city    = $ResultVar['city'];
  $state    = $ResultVar['state'];
  $zip    = $ResultVar['zip'];
  $email    = $ResultVar['cu_email'];
  $phone    = $ResultVar['phone'];

  $conn->close();

  //-----end get db results----------


  require_once("braintree_php-master/lib/Braintree.php");
/*
 Braintree_Configuration::environment('sandbox');
 Braintree_Configuration::merchantId('tvq69wgjrp97jzyp');
 Braintree_Configuration::publicKey('bt9vcxv9hydnv4vy');
 Braintree_Configuration::privateKey('c33cd9ac97b7f628dafab12c19a33313'); */

 $gateway = new Braintree_Gateway([
  'environment' => 'sandbox',
  'merchantId' => 'tvq69wgjrp97jzyp',
  'publicKey' => 'bt9vcxv9hydnv4vy',
  'privateKey' => 'c33cd9ac97b7f628dafab12c19a33313'
]);

 //$clientToken = Braintree_ClientToken::generate();

 $clientToken = $gateway->clientToken()->generate();

$nonceFromTheClient = $_POST["payment_method_nonce"];
$amountFromTheClient =$_POST["orderAmount"];



  // $result = Braintree_Transaction::sale
  $result = $gateway->transaction()->sale([
    'amount' => $amountFromTheClient,
    'paymentMethodNonce' => $nonceFromTheClient,
    'customer' => [
      'id' => $checkoutCustomerID,
      'firstName' => $fName ,
      'lastName' =>  $lName ,
      'phone' => $phone,
      'email' =>  $email
    ],
    'billing' => [
      'firstName' => $fName ,
      'lastName' =>  $lName ,
      'streetAddress' => $street,
      'locality' => $city,
      'region' => $state,
      'postalCode' => $zip,
      'countryCodeAlpha2' => 'US'
    ],
    'options' => [
      'submitForSettlement' => True
    ]
  ]);
// echo $result;

if($result->success)
{
    $transaction = $result->transaction;
    //-------define results parser variables-----------
    $t_id = $transaction->id;
    $t_processor = 'Braintree';
    $t_type = $transaction->paymentInstrumentType;
    $t_amount = $transaction->amount;
    $t_status = $transaction->status;
    if ($t_status == "submitted_for_settlement"){
      $t_status = "Successful";
    }
    $t_fname = $transaction->customerDetails->firstName;
    //------end variable definitions

    //---------Update the Order in the DB----------
    require "dbconn.php";

    $cust    = $checkoutCustomerID;
    $amount    = $t_amount;
    $status    = $t_status;
    $transaction = $t_id;

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
    $conn->close();
     //---------end db order update--------

    //---begin success splash build---------
    echo "
      <h1 class='text-center'>Thank you for your payment ".$t_fname."!</h1>
      <h3 class='text-center'>Order ".$last_orderID." Details:</h3>
      <h4 class='text-center'><b>Payment Status: </b>". $t_status."   <b>Transaction ID: </b>".$t_id." </h4>
      <br>
      <br>
      <div style='margin:auto;width: 60%'>
      ";
      echo "
      <table class='table-bordered pull-right'>
      ";
      echo "
      <hr>
      <tr>
          <td><b>Total:</b></td><td><b>".$t_amount."</b></td>
      </tr>
      </table>
      </div>
    ";
    //------------end success splash----------------

}
else
{
    $status = $result->transaction->status; // "processor_declined"
    if($status == 'gateway_rejected')
    {
        return back()->with('danger','Transaction was rejected. Please validate your information and try again.');
    }
    // $r_code = $result->transaction->processorResponseCode; // e.g. 2000
    $err_text = $result->transaction->processorResponseText;

    return back()->with('danger','Transaction was not successful. Reason: '.$err_text);
}

?>
<script>
resetcart();
</script>
