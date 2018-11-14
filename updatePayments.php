<?php 
//-------get database payment methods----
require "dbconn.php";
$sql = "SELECT * FROM payments";
$result = $conn->query($sql);
//---------------------------------------

//--------build array from database items---------
$methods=array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($methods, $row["paymentID"]);
    }
}
//------------end array build----------------------

//------loop through new array, update each one to database-------------
foreach ($methods as $method) {

    $active_update = !empty($_GET[$method.'_method']);
    //changes variable grammar for DB boolean--
    if ($active_update == "on"){
        $active_update = "1";
    }
    else {
        $active_update = "0";
    }
    //----end grammar correction--------------

    $sql = "UPDATE payments SET paymentActive='$active_update' WHERE paymentID=$method";
    $success = $conn->query($sql);
    if (!$success) {
        die("Couldn't update data: ".$conn->error);
    
    }
}//------------end loop--------------------------------------------------

unset($method);
header( 'Location: admin.php?payments=true' );
$conn->close();
?>