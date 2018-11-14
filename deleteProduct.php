<?php 
require "dbconn.php";

$prod_id= $_REQUEST['product'];
$sql = "DELETE FROM products WHERE product_id=$prod_id";
$success = $conn->query($sql);

if (!$success) {
    die("Couldn't enter data: ".$conn->error);
 
}
header( 'Location: admin.php?editProducts=true' ) ;
 
$conn->close();
?>
