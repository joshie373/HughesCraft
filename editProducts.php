<?php
require "dbconn.php";
include "addImages.php";
$sql = "SELECT * FROM products";

$result = $conn->query($sql);
?>
    <a href='admin.php?add=true'><span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp&nbspAdd New</a><br>
    <h4>Edit Products</h4>
  <table class="table table-striped">
<thead>
    <tr>
        <th>Visible</th>
        <th></th>
        <th>Product_ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
        <th></th>
    </tr>
</thead>
<tbody>
<form role="form" action="updateProducts.php" method="get">
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
       echo 
       "<tr>". "
       <td><input name='".$row["product_id"]."_visible' type='checkbox' class=checkbox' ". $visible ."></td>
       <td><a class='upload' id='".$row["product_id"]."' data-toggle='modal' data-target='#uploadModal'><span class='glyphicon glyphicon-picture'></span>&nbsp&nbspUpload Images</a></td>
       <td> ". $row["product_id"] . "</td>
       <td><input name='".$row["product_id"]."_title' type='text' class='form-control input-sm' value='" .$row["title"]. "'></td>
       <td><input name='".$row["product_id"]."_descript' type='text' class='form-control input-sm' value='" . $row["description"]. "'></td>
       <td><input name='".$row["product_id"]."_price' type='text' class='form-control input-sm' value='" . $row["price"]. "'></td>
       <td><a href='deleteProduct.php?product=".$row["product_id"]."'><span class='glyphicon glyphicon-trash'></span></a></td>
       </tr>";
    }
    ?>
       <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp&nbspSave</button>
</form>
    </tbody>
</table>

<?php 
} else {
    echo "0 results";
}
$conn->close();
?>
 

 <div id="uploadModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Upload Multiple Files</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="upload_form">  
                          <label>Select Multiple Image</label>  
                          <input type="file" name="images[]" id="select_image" multiple />  
                     </form>  
                </div>  
           </div>  
      </div>  
 </div>  
 <script>  
 $('.upload').click(function(){
    var clicked = $(this).attr('id');

      $('#select_image').change(function(){3 
           $('#upload_form').submit();  
      });  
      $('#upload_form').on('submit', function(e){  
          
           e.preventDefault();  
           $.ajax({  
                url :"upload.php?product="+ clicked,  
                method:"POST",  
                data: new FormData(this),  
                contentType:false,  
                processData:false,  
                success:function(data){  
                     $('#select_image').val('');  
                     $('#uploadModal').modal('hide');  
                     $('#gallery').html(data);
                     clicked ="";  
                }  
           })
      });  
 });  

 </script>  
