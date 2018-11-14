function populateCart() {
    var cnt = loadCart();
    var crtBtnText= "<span class='glyphicon glyphicon-shopping-cart' style='font-size:20px;color:#000000;'></span>&nbspView Cart";
    $("#viewCart").empty();
      if (cnt==0){
        $("#viewCart").append(crtBtnText);
      }
      else {
      $("#viewCart").append(crtBtnText+"("+cnt+")");
      }

  }

  function updateCart(){
    var lastCartRow = (cartTable.rows.length) - 1;
    var crtCntUpdated = cartTable.rows[lastCartRow].cells[4].innerHTML;
      document.cookie = "cartCount="+crtCntUpdated+"";
      $.cookie('cartCount', crtCntUpdated,{ path: '../shop' });
  }

  $( document ).ready(populateCart());

  function changeQuant(){
  for ( var i = 1; i < cartTable.rows.length-1; i++ ) {
      cartArr.push({
          prod_id: cartTable.rows[i].cells[0].innerHTML,
          title: cartTable.rows[i].cells[1].innerHTML,
          descript: cartTable.rows[i].cells[2].innerHTML,
          price: (cartTable.rows[i].cells[3].innerHTML).substr(1),
          qty: cartTable.rows[i].cells[4].children[0].value,
      });
      
  }
    console.log(cartArr);
    var cartArrCook = JSON.stringify(cartArr);
  document.cookie = "products="+cartArrCook+"";
  $.cookie("products", cartArrCook);
 

   //location.reload();
  updateCart();
  populateCart();
}        

//validators
      function isNumberKey(evt)
    {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;

      return true;
    }
//-end validators


$("#crtReset").click(function(){
    resetcart();
  });
  var cartTable = document.getElementById("cartTable");
    var cartArr = [];
  $(".qtyCart").change(function(){
    
    changeQuant();

    

    //  updateCart();
    //  populateCart();
     location.reload();
  });
  $(".deletecart").click(function(){
    var removeItem = $(this).attr('id');
    $('#row'+removeItem+'').remove();
    changeQuant();
    // updateCart();
    // populateCart();
  });
