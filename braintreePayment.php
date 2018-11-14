<?php

include "linkRefs.php";
require_once("braintree_php-master/lib/Braintree.php");

/* Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('tvq69wgjrp97jzyp');
Braintree_Configuration::publicKey('bt9vcxv9hydnv4vy');
Braintree_Configuration::privateKey('c33cd9ac97b7f628dafab12c19a33313'); */

$gateway = new Braintree_Gateway([
  'environment' => 'sandbox',
  'merchantId' => 'tvq69wgjrp97jzyp',
  'publicKey' => 'bt9vcxv9hydnv4vy',
  'privateKey' => 'c33cd9ac97b7f628dafab12c19a33313'
]);
// echo($clientToken = Braintree_ClientToken::generate());
// $clientToken = Braintree_ClientToken::generate();
$clientToken = $gateway->clientToken()->generate();

//testng!! remove!!
// echo $clientToken;

?>
    <!-- include drop in library -->
  <script src="https://js.braintreegateway.com/web/dropin/1.9.2/js/dropin.min.js"></script>


  <div id="dropin-container"></div>
  <button id="submit-button">Submit Payment</button>
    <form id="checkout-form" action="braintreeConfirm.php" method="post">
        <input type="hidden" name="payment_method_nonce">

        <!-- order details hidden fields-->
        <input type= "hidden" id="checkoutFormCustId" name="checkoutFormCustId" >
        <input type= "hidden" id="orderAmount" name="orderAmount" >
        <!-- end order details -->

    </form>

  <script>
  $(document).ready(function(){
    //--set order details--------
    $("#orderAmount").val($("#cartTotal").val());
    //----end set order details--
  });
    var button = document.querySelector('#submit-button');
    var form = document.querySelector('#checkout-form');

    braintree.dropin.create({
      authorization: '<?php echo $clientToken; ?>',
      container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          // Submit payload.nonce to your server
          document.querySelector('input[name="payment_method_nonce"]').value = payload.nonce;
          form.submit()
        });
      });
    });
  </script>
<?php


?>
