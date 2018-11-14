<?php
include "dbconn.php";
$sql = "SELECT * FROM customers";

$result = $conn->query($sql);
?>
  <table class="table table-striped">
<thead>
    <tr>
        <th>Customer ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Street</th>
        <th>City</th>
        <th>State</th>
        <th>Zip</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
</thead>
<tbody>
<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

       echo "<tr>". "<td>" . $row["customerID"]."</td><td> ". $row["fName"] . "</td><td> " .$row["LName"]. "</td><td> " . $row["street"]. "</td><td> " . $row["city"]. "</td><td> " . $row["state"]. "</td><td> " . $row["zip"]. "</td><td> " . $row["cu_email"]. "</td><td> " . $row["phone"]. "</td></tr>";
    }
   
    ?>
    </tbody>
</table>
<?php 
} else {
    echo "0 results";
}
$conn->close();
?>