<!DOCTYPE html>
<html>
  <head>
    <?php 
    include "linkRefs.php";

?>

    <title>HughesCraft-Shop</title>
  </head>
  <?php include "header.php"?>
  
  <body>
  <div class="container">
  <div class="row">

  <?php
    include "dbconn.php";
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
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
                  data-backdrop='static' 
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
          <h4 style="font-size:28px;" id="modDetail_Title" class="modal-title"></h4>
        </div>
        <div class="modal-body">
        <div class="row">
          <div class="col-md-6 text-center">
          <p class="text-left" style="display:inline;font-size:14px;">Product ID:</p>
            <b><p id="modDetail_ProdID" class="text-center" style="display:inline;font-size:18px;"></p></b>
            <img src="http://vyfhealth.com/wp-content/uploads/2015/10/yoga-placeholder1.jpg" class="img-polaroid left-block" style="width:250px;height:200px;"/>
          </div>
          <div class="col-md-6 text-center">
            <br>
            <br>
            <p class="text-center" style="display:inline;font-size:16px;">Price:</p>
            <b><p style="display:inline;font-size:24px;">$</p><p class="text-center" id="modDetail_price" style="display:inline;font-size:24px;"></p></b>
            <br>
            <br><label for="quantity">Qty:</label>
            <input name="quantity" id="quantity" style="width: 50px;" type="number" value="1"></input>
          </div>
        </div>
        <hr>
        <div width="90%">
          <p id="modDetail_descript"></p>
        </div>
        </div>
        <div class="modal-footer">
          <button id="addCart" class="btn btn-lg btn-primary pull-left" >Add to cart</button>
          <p id="added" class="text-center"></p> 
          <button id="closeModal"type="button" class="btn btn-default" data-dismiss="modal">Close</button><br>
        </div>
        <div class="center-block text-center">
        <hr>
          <a style='font-size:16px;color:#000000;' id="btnModalToCart" href="cart.php"><span class='glyphicon glyphicon-shopping-cart'></span>&nbspGo To Cart</a><br><br>
        </div>
     
      </div>
      
    </div>
  </div>
  <script>  

  // -----------sets modal content------
 $('.carousel-inner').click(function(){
    var title = $(this).attr('data-title');
    var price = $(this).attr('data-price');
    var descript = $(this).attr('data-descript');
    var prodID =$(this).attr('data-product_id');
    $("#modDetail_Title").text(title); 
    $("#modDetail_price").text(price);
    $("#modDetail_descript").text(descript);
    $("#modDetail_ProdID").text(prodID);

 });  
 title="";
 price="";
 descript="";
 prodID="";
//  -------------end modal content set

//-------------controls add to cart functions
 $("#addCart").click(function(){
 var cnt = addCartCnt($("#modDetail_ProdID").text(),$("#modDetail_Title").text(),$("#modDetail_descript").text(),$("#modDetail_price").text(),$("#quantity").val());
 //resetcart();
$("#addCart").hide();
$("#viewCart").empty();
$("#viewCart").append("<span class='glyphicon glyphicon-shopping-cart' style='font-size:20px;color:#000000;'></span>&nbspView Cart"+"("+cnt+")");
$("#added").css({'background-color':'#239b33','color': '#ffffff','font-size': '16px'});
$("#added").html("<span class='glyphicon glyphicon-check'></span>&nbspAdded to cart!");
//-------end add to cart functions----------

//------resets modal content on close
$("#closeModal").click(function(){
  
  $('#product_desc_modal').modal('toggle');

  $("#quantity").val(1);
  $("#addCart").show();
  $("#added").removeAttr('style');
  $("#added").text("");
  $('#product_desc_modal').modal('dismiss');
});

});
//---end reset modal contet--------


//--------set cart counter in header-----
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
//-------- end set cart counter -----
 </script>  
</html>
