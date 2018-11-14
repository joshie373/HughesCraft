<!DOCTYPE html>
<html>
  <head>
    <?php include "linkRefs.php";
     ?>
    <title>HughesCraft-Admin</title>
  </head>
  <?php include "header.php"?>
  <body>
  <a href="index.php"><button class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp&nbspReturn to Site</button></a><br>
  <div class="row">
      <br>
    <div class="col-md-2">
    <hr>
        <ul class="nav nav-pills nav-stacked">
            <li class="<?php if (isset($_GET['products'])||isset($_GET['add'])||isset($_GET['editProducts'])){echo "active";} ?>"><a href='admin.php?products=true'><span class="glyphicon glyphicon-barcode"></span>&nbsp&nbsp&nbspProducts</a></li>
            <li class="<?php if (isset($_GET['admins'])){echo "active";} ?>"><a href='admin.php?admins=true'><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp&nbspAdmins</a></li>
            <li class="<?php if (isset($_GET['orders'])){echo "active";} ?>"><a href='admin.php?orders=true'><span class="glyphicon glyphicon-tags"></span>&nbsp&nbsp&nbspOrders</a></li>
            <li class="<?php if (isset($_GET['payments'])){echo "active";} ?>"><a href='admin.php?payments=true'><span class="glyphicon glyphicon-usd"></span>&nbsp&nbsp&nbspPayments</a></li>
            <li class="<?php if (isset($_GET['customers'])){echo "active";} ?>"><a href='admin.php?customers=true'><span class="glyphicon glyphicon-list-alt"></span>&nbsp&nbsp&nbspCustomers</a></li>
        </ul>
    </div>
    <!--start options list script, dynamically loads based on selection  -->
    <div id="adminWrap" class="col-md-10">
       <?php
        //products sections
            function getProducts() {
                include "products.php";
            }
            function getAddProduct() {
                include "addProduct.php";
            }
            function getEditProducts() {
                include "editProducts.php";
            }

            if (isset($_GET['products'])) {
                getProducts();
            }
            if (isset($_GET['add'])) {
                getAddProduct();
            }
            if (isset($_GET['editProducts'])) {
                getEditProducts();
            }

        //admins sections
            function getAdmins() {
                include "admins.php";
            }
            if (isset($_GET['admins'])) {
                getAdmins();
            }

        //orders sections
            function getOrders() {
                include "orders.php";
            }
            if (isset($_GET['orders'])) {
                getOrders();
            }

        //payments sections
            function getPayments() {
                include "payments.php";
            }
            if (isset($_GET['payments'])) {
                getPayments();
            }

        //customers sections
        function getCustomers() {
            include "customers.php";
        }
        if (isset($_GET['customers'])) {
            getCustomers();
        }

        ?>
    </div>
</div>
</body>
</html>
