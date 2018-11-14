<!DOCTYPE html>
<html>
  <head>
    <?php include "linkRefs.php" ?>
    <title>HughesCraft</title>
    
  </head>
  <?php include "header.php"?>
  <body>
  <h2>Welcome to Hughescraft.</h2>
  <h3>This site demonstrates a Shopping cart built completely with PHP with payment methods integrated.</h3>
  <h3>Here are some of the Key features:</h3>
  <ul>
  <li>Database connection with MySQL database</li>
  <li>Bootstrap CSS</li>
  <li>Bootstrap Jquery</li>
  <li>Bootstrap JS modals and content</li>
  <li>Fully functional shopping cart</li>
  <li>Administration panel to ecommerce settings</li>
  <li>Integrated Sandbox payment methods</li>
  <li>Inventory management functionality</li>
  </ul>

  </body>
  <script>
$( document ).ready(function() {
  var cnt = loadCart();
  var crtBtnText= "<span class='glyphicon glyphicon-shopping-cart' style='font-size:20px;color:#000000;'></span>&nbspView Cart";
  $("#viewCart").empty();
  if (cnt==0){
  $("#viewCart").append(crtBtnText);
  }
  else {
    $("#viewCart").append(crtBtnText+"("+cnt+")");
  }
});
  </script>
</html>
