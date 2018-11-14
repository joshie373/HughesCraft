<?php 
require "dbconn.php";


$fName    = $conn->real_escape_string($_POST['custForm_fName']);
$lName    = $conn->real_escape_string($_POST['custForm_lName']);
$street    = $conn->real_escape_string($_POST['custForm_street']);
$city    = $conn->real_escape_string($_POST['custForm_city']);
$state    = $conn->real_escape_string($_POST['custForm_state']);
$zip    = $conn->real_escape_string($_POST['custForm_zip']);
$email    = $conn->real_escape_string($_POST['custForm_email']);
$phone    = $conn->real_escape_string($_POST['custForm_phone']);

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
    
    //testing
    echo json_encode( array('custId'=> $last_customerID));
 }
 

$conn->close();
?>
