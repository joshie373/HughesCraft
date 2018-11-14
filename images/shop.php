<!DOCTYPE html>
<html>
  <head>
    <?php include "linkRefs.php" ?>
    <?php
include "dbconn.php";
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

    <title>HughesCraft-Shop</title>
  </head>
  <?php include "header.php"?>
  
  <body>
  <div class="container">
  <div class="row">

  <?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($row["visible"] == 1){
          $imgArr=array();
          $j=0;
          $images = glob("images/".$row["product_id"]."/*.*");  
          foreach($images as $image)  
          {  
            array_push($imgArr, $image);
            
          } 

          echo "
          <div  class='col-md-3' style='border:1px solid #cecece; padding:0px;margin:10px;'>
            <div id='myCarousel".$row["product_id"]."' class='carousel slide center-block' 'style='width:250px;height:160px;'>
              <div class='carousel-inner' 
                data-toggle='modal' 
                data-target='#product_desc_modal' 
                data-product_id='".$row["product_id"]."' 
                data-title='".$row["title"]."'
                data-price='".$row["price"]."' 
                data-descript='".$row["description"]."' 
              >
                ";
                for ($i=0;$i<count($imgArr);$i++){
                  if ($i==0){
                  echo "
                  <div class='item active'>
                    <img src='".$imgArr[$i]."' class='img-polaroid center-block' style='width:200px;height:160px;'>
                  </div>
                  ";
                  }
                  else {
                    echo "
                    <div class='item'>
                      <img src='".$imgArr[$i]."' class='img-polaroid center-block' style='width:200px;height:160px;'>
                    </div>
                    ";
                    }
                  }
                echo "

              </div>
              <a class='left carousel-control' href='#myCarousel".$row["product_id"]."' data-slide='prev'>
              <span class='glyphicon glyphicon-chevron-left'></span>
              <span class='sr-only'>Previous</span>
            </a>
            <a class='right carousel-control' href='#myCarousel".$row["product_id"]."' data-slide='next'>
            <span class='glyphicon glyphicon-chevron-right'></span>
            <span class='sr-only'>Next</span>
          </a>
            </div>
            <p class='text-center'><b>".$row["title"]."</b><br>
              $".$row["price"]."
            </p>
          </div>
          ";
        }
    }
    $j++;
  }
    ?>
</div>
</div>
  </body>
<!--full modal -->
  <div class="modal fade" id="product_desc_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id="modDetail_Title" class="modal-title"></h4>
        </div>
        <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <img src="http://vyfhealth.com/wp-content/uploads/2015/10/yoga-placeholder1.jpg" class="img-polaroid left-block" style="width:300px;height:240px;"/>
          </div>
          <div class="col-md-6 text-center">
            <b><p style="display:inline;font-size:24px;">$</p><p class="text-center" id="modDetail_price" style="display:inline;font-size:24px;"></p></b>
          </div>
        </div>
        <hr>
        <div width="90%">
          <p id="modDetail_descript"></p>
        </div>
        </div>
        <div class="modal-footer">
          <button id="addCart" class="btn btn-lg btn-primary pull-left">Add to cart</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <script>  
 $('.carousel-inner').click(function(){
    var title = $(this).attr('data-title');
    var price = $(this).attr('data-price');
    var descript = $(this).attr('data-descript');
    
    $("#modDetail_Title").text(title); 
    $("#modDetail_price").text(price);
    $("#modDetail_descript").text(descript);

 });  
 title="";
 price="";
 descript="";

 $("#addCart").click(function(){
 var cnt = addCartCnt($("#modDetail_Title").text(),$("#modDetail_descript").text(),$("#modDetail_price").text());
//  resetcart();
$("#viewCart").empty();
$("#viewCart").append("<span class='glyphicon glyphicon-shopping-cart' style='font-size:20px;color:#000000;'></span>&nbspView Cart"+"("+cnt+")");
$("#addCart").css('background-color','#239b33');
$("#addCart").text("<span class='glyphicon glyphicon-check'></span>&nbspAdded to cart!");
$("#addCart".)attr("disabled","disabled");
var wait = function(){
  $('#product_desc_modal').modal('toggle');
};
setTimeout(wait, 3000);
});

//testing storage


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
