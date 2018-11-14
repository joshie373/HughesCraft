<!--This page populates the form to submit to add new items  -->
<?php
require "dbconn.php";
?>
<div class="col-sm-6 col-sm-offset-3 text-center">
<div class="well">
    <h3>Add New Item</h3>
    <form role="form" action="added.php" method="post">
        <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter product title">
        </div>
        <div class="form-group">
        <label for="price">Price</label>
        <input type="text" class="form-control" name="price" id="price" placeholder="Enter product price">
        </div>
        <div class="form-group">
        <label for="descript">Product Description</label>
        <input type="text" class="form-control" name="descript" id="descript" placeholder="Enter product description">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</div>
<?php
/* $sql = "INSERT INTO products (visible,title, description, price)
VALUES ('1','thing', 'this is a thing', '14.99')"; */
?>
