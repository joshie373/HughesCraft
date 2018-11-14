<?php 
//-----function to retrieve details from DB items___
function getDBResult($col,$id){
    include "dbconn.php";
    
    $sql = "SELECT ".$col." FROM products WHERE product_id=".$id."";
    $result = $conn->query($sql);
    $ResultVar = mysqli_fetch_assoc($result);
    $attempts = $ResultVar[$col];
    $conn->close();
    return $attempts;
}
    //-----end getdbresult----------


function PPECItemsList(){
    $products = json_decode($_COOKIE["products"], TRUE);
    echo "
    \"items\": [
        ";
    //------------start items array--------
    for($i=0;$i < count($products);$i++){
            echo "
            { 
                \"name\": \"".getDBResult("title",$products[$i]['prod_id'])."\",
                \"sku\": \"".$products[$i]['prod_id']."\",
                \"price\": \"".getDBResult("price",$products[$i]['prod_id'])."\",
                \"currency\": \"USD\",
                \"quantity\": \"".$products[$i]['qty']."\",
                \"description\": \"".getDBResult("description",$products[$i]['prod_id'])."\"
            ";
            if ((count($products)-1)==$i){
                echo "}";
            }
            else {
                echo "},";
            }
    }
    echo "]";//----------end items array----------
    return;
}

function buildTransactions(){
    $products = json_decode($_COOKIE["products"], TRUE);
    
    //loop through array to get total--start-----
        $cartTotal = 0;
        $qtyTotal=0;
        for($i=0;$i < count($products);$i++){
            $qty = $products[$i]['qty'];
            $cartTotal=$cartTotal + ((float)$qty * getDBResult("price",$products[$i]['prod_id']));
        }
    //totaler end--------------------------------

    //------------------finish building JSON------
    $shipping = 5.00;
    $cartTotalTotal = (float)$cartTotal + (float)$shipping;
    echo "
    {
        \"intent\": \"sale\",
        \"payer\": {\"payment_method\": \"paypal\"},
    \"transactions\": [
        {
          \"amount\": {
            \"total\": \"".$cartTotalTotal."\",
            \"currency\": \"USD\",
            \"details\": {
              \"subtotal\": \"".$cartTotal."\",
              \"shipping\": \"".$shipping."\"
            }
          },
          \"description\": \"Your HughesCraft Cart Items.\",
          \"item_list\": { 
    ";
    echo PPECItemsList();
    echo "
          }
        }
    ]
    ,
    \"note_to_payer\": \"Contact us for any questions on your order.\",
    \"redirect_urls\": {\"return_url\": \"https://www.example.com/return\",\"cancel_url\": \"https://www.example.com/cancel\"}
}
    ";
//---endJSON build---------------------------
}

?>