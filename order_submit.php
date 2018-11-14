<?php 
require "dbconn.php";


$cust    = $conn->real_escape_string($_POST['orderFormCustId']);
$amount    = $conn->real_escape_string($_POST['orderAmount']);
$status    = $conn->real_escape_string($_POST['orderStatus']);


$query   = "INSERT into orders (customer_id,amount,status) VALUES(
'" . $cust . "',
'" . $amount . "',
'" . $status . "'
)";
$success = $conn->query($query);
 
if (!$success) {
    die("Couldn't enter data: ".$conn->error);
}
 else {
    $last_orderID = $conn->insert_id;
    
    //testing
    echo json_encode( array('orderID'=> $last_orderID));
 }
 

$conn->close();
?>
