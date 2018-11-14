<?php
include "dbconn.php";
$sql = "SELECT * FROM orders";

$result = $conn->query($sql);
?>
  <table class="table table-striped">
<thead>
    <tr>
        <th>Order ID</th>
        <th>Customer ID</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Transaction ID</th>
        <th>Order Date</th>
    </tr>
</thead>
<tbody>
<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

       echo "<tr>". "<td>" . $row["orderID"]."</td><td> ". $row["customer_id"] . "</td><td> " .$row["amount"]. "</td><td> " . $row["status"]. "</td><td> " . $row["transactionID"]. "</td><td> " . $row["order_date"]. "</td></tr>";
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