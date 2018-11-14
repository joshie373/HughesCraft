<!DOCTYPE html>
<html>
  <head>
    <?php include "linkRefs.php";
 ?>
    <title>HughesCraft-Cart</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
  </head>
  <?php include "header.php";
  //----------check if paypal EC active------------
   function getExpressCheckoutStatus(){
    include "dbconn.php";
    $sql = "SELECT paymentActive FROM payments WHERE paymentID='100'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
        if ($row["paymentActive"]== 1){
          return true;
        }
        else {
          return false;
        }
    $conn->close();
   }
 //--------end EC Check-----------------------
  ?>
  <body>
    <h3 class="text-center">Your Cart</h3>
    <p id="cartContainer"></p>
    <div id="mainWrapper">
      <div id="main">
        <script src="cart.js"></script><!--cart functionality code-->
        <?php buildCart(); ?>
        <?php 
        function buildCart() {
          //check if cart is empty
          if (!isset($_COOKIE["products"])){
            echo "<div class='col-sm-8 col-sm-offset-2 text-center'>
            <div class='well'>Your Cart is empty!</div>
          </div>";
          }
          else {
          $products = json_decode($_COOKIE["products"], TRUE);
          $cartTotal = 0;
          $qtyTotal=0;


            // build table
            echo "
              <div class='col-sm-8 col-sm-offset-2 text-center'>
              <a id='crtReset' href=''><button class='btn btn-sm pull-right'><b><span class='glyphicon glyphicon-trash' style='color:#FF1111;'></span> Clear Cart</button></b></a><br>
              <div class='well'>
                  <table id='cartTable' class='table'>
                      <thead>
                          <tr>
                              <th class='text-left col-xs-1'>Product ID</th>
                              <th class='text-center'>Title</th>
                              <th class='text-center'>Description</th>
                              <th class='text-right'>Price</th>
                              <th class='text-center'>Qty</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
            ";

            // loop through array
            
            for($i=0;$i < count($products);$i++){
              echo "
              <tr id='row".$products[$i]['prod_id']."'>
                <td>".$products[$i]['prod_id']."</td>
                <td>".$products[$i]['title']."</td>
                <td>".$products[$i]['descript']."</td>
                <td class='text-right'>$".$products[$i]['price']."</td>
                <td><input class='qtyCart' name='qtyCart' id='qtyCart' style='width: 50px;' type='number' value='".$products[$i]['qty']."' onkeypress='return isNumberKey(event)'></input></td>
                <td><a href='' class='deletecart' id='".$products[$i]['prod_id']."'><span class='glyphicon glyphicon-remove-circle' style='color:#FF1111;font-size:15px;'></span></a></td>
              </tr>";
              $qty = $products[$i]['qty'];
              $cartTotal=$cartTotal + ((float)$qty * $products[$i]['price']);
              $qtyTotal=$qtyTotal + (float)$qty;
            }

            //finish building table
            echo "
                    </tbody>
                    <tfoot>
                      <tr>
                        <td></td>
                        <td></td>
                        <td class='text-right'><b>Total:</b></td>
                        <td class='text-right'>$<input class='text-right' id='cartTotal' style=' background: transparent;border: none;width:54px;' value='".$cartTotal."' disabled></td>
                        <td>".$qtyTotal."</td>
                        <td></td>
                      </tr>
                    </tfoot>
                  </table>
                <hr>
            ";


            //Payment methods here-----
            echo " 
            <div class='row'>
            <div class='col-md-5'>
            </div>
            <div class='col-md-7 pull-right'>
              <div class='row'>
                <div class='col-md-5'>
                  <a id='PP_EC_Cart' href='checkout.php'><button class='btn-lg btn-primary ' style='background-color:#0e2466; width:90%;'>Checkout</button></a>
                </div>
                <div class='col-md-7'>
                  ";
                    if (getExpressCheckoutStatus()){
                      echo "<div class='pull-right' id='paypal-button-container'></div>";
                    }
                    else {
                      echo "";
                    }
                  
                  echo "
                </div>
              </div>  
            </div>
          </div>
            ";
            //-------------------------
            echo " </div><hr><a href='shop.php'>Back to shop</a></div>";
          }
          }
          
        ?>     
      </div>
    </div>
  </body>
  <script src="paypal.js"></script><!-- paypal express Checkout -->
  <?php $time = time(); ?>
  <script src="cart.js?t=<?php echo $time; ?>">
      updateCart();
      populateCart();
  </script>

  <!-- PayPal BEGIN MUSE -->
  <script> 
  ;(function(a,t,o,m,s){a[m]=a[m]||[];a[m].push({t:new Date().getTime(),event:'snippetRun'});var f=t.getElementsByTagName(o)[0],e=t.createElement(o),d=m!=='paypalDDL'?'&m='+m:'';e.async=!0;e.src='https://www.paypal.com/tagmanager/pptm.js?id='+s+d;f.parentNode.insertBefore(e,f);})(window,document,'script','paypalDDL','109d0592-b4f6-11e7-8317-99af5f11ae50'); 
  </script>
  <!-- PayPal END -->
</html>
