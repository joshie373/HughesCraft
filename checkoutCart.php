<?php 
 include "linkRefs.php";

        $products = json_decode($_COOKIE["products"], TRUE);
        $cartTotal = 0;
        $qtyTotal=0;


          // build table
          echo "
                <table id='miniCartTable' class='table'>
                    <thead>
                        <tr>
                            <th class='text-left col-xs-1'>Product ID</th>
                            <th class='text-center'>Title</th>
                            <th class='text-right'>Price</th>
                            <th class='text-center'>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
          ";

          $ship=5.00;
      

          // loop through array
          for($i=0;$i < count($products);$i++){
            echo "
            <tr id='row".$products[$i]['prod_id']."'>
              <td>".$products[$i]['prod_id']."</td>
              <td class='text-center'>".$products[$i]['title']."</td>
              <td class='text-right'>$".$products[$i]['price']."</td>
              <td class='text-right'>".$products[$i]['qty']."</td>
            </tr>
            ";
            $qty = $products[$i]['qty'];
            $cartTotal=$cartTotal + ((float)$qty * $products[$i]['price']);
            $qtyTotal=$qtyTotal + (float)$qty;
          }
          echo "
             <tr style='font-weight: italic;'>
                <td></td>
                <td>Shipping:</td>
                <td class='text-right'>$".(float)$ship."</td>
                <td></td>
            </tr>
          ";
          $cartTotal = $cartTotal + (float)$ship;
          //finish building table
          echo "
                  </tbody>
                  <tfoot>
                    <tr style='font-weight: bold;'>
                      <td></td>
                      <td class='text-right'>Total:</td>
                      <td class='text-right'>$<input class='text-right' id='cartTotal' style=' background: transparent;border: none;width:54px;' value='".$cartTotal."' disabled></td>
                      <td class='text-right'>".$qtyTotal."</td>
                    </tr>
                  </tfoot>
                </table>
                <hr>
                <a class='pull-right' href='cart.php'>Back to cart</a><br>
                <br>
            ";
?>