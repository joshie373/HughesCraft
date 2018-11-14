<?php

// change the name below for the folder you want
require "dbconn.php";
$sql = "SELECT * FROM products";

$result = $conn->query($sql);
$products=array();
if ($result->num_rows > 0) {
    // output data of each row into array
    while($row = $result->fetch_assoc()) {
        array_push($products, $row["product_id"]);
    }
}

// begin loop
foreach ($products as $product) {

    $dir = "images/".$product;
    if( is_dir($dir) === false )
    {
        mkdir($dir);
    }

}
?>
