<?php
//----------get all products from database-------
include "dbconn.php";
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
//------------end get products-------------------
?>
    <a href='admin.php?add=true'><span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp&nbspAdd New</a>&nbsp&nbsp
    <a href='admin.php?editProducts=true'><span class="glyphicon glyphicon-pencil"></span>&nbsp&nbspEdit items</a><br/>
  <table class="table table-striped">
<thead>
    <tr>
        <th>Visible</th>
        <th>Product_ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
    </tr>
</thead>
<tbody>
<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($row["visible"] == 1){
            $visible= "checked";
        }
        else {
            $visible="unchecked";
        }
       echo "<tr>". "<td><input type='checkbox' class=checkbox' ". $visible ." disabled></td><td> ". $row["product_id"] . "</td><td> " .$row["title"]. "</td><td> " . $row["description"]. "</td><td> " . $row["price"]. "</td></tr>";
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