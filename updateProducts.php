<?php 
//-------get database product----
require "dbconn.php";
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
//---------------------------------------

//-----------------build array of database product ids------------
$products=array();
if ($result->num_rows > 0) {
    // output data of each row into array
    while($row = $result->fetch_assoc()) {
        array_push($products, $row["product_id"]);
    }
}
//------------end array build----------------------

//------loop through new array, update each one to database-------------
foreach ($products as $product) {
    $title_update    = $_GET[$product.'_title'];
    $price_update   = $_GET[$product.'_price'];
    $descript_update    = $_GET[$product.'_descript'];
    $visible_update = !empty($_GET[$product.'_visible']);
    //changes variable grammar for DB boolean--
    if ($visible_update == "on"){
        $visible_update = "1";
    }
    else {
        $visible_update = "0";
    }
    //----end grammar correction--------------

    $sql = "UPDATE products SET visible='$visible_update', title='$title_update', price='$price_update', description='$descript_update' WHERE product_id=$product";
    $success = $conn->query($sql);

    if (!$success) {
        die("Couldn't update data: ".$conn->error);

    }
}//------------end loop--------------------------------------------------
unset($product);
header( 'Location: admin.php?products=true' );
$conn->close();
?>
