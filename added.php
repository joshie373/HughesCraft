<?php
// scriptlet to add items to database
require "dbconn.php";
$title    = $conn->real_escape_string($_POST['title']);
$price   = $conn->real_escape_string($_POST['price']);
$descript    = $conn->real_escape_string($_POST['descript']);
$visible= (isset($_GET['visible']));

if($visible="on"){
    $visible = "1";
}
if($visible="off"){
    $visible = "0";
}
$sql   = "INSERT into products (visible,title, description, price) VALUES('" . $visible . "','" . $title . "','" . $descript . "','" . $price . "')";
$success = $conn->query($sql);

if (!$success) {
    die("Couldn't enter data: ".$conn->error);

}
header( 'Location: admin.php?products=true' );

$conn->close();
?>
