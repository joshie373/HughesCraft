<!DOCTYPE html>
<html>
  <head>
    <?php include "linkRefs.php";
     ?>
    <title>HughesCraft-About</title>

  </head>
  <?php include "header.php"?>
  <body>
  </body>
  <script>
  //script that calls function to get cart cookie and outputs as variable.
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
