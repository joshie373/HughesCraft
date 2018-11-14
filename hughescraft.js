function addCartCnt(prod_id,title,descr,price,qty){
    
     var xv = loadCart();

      //item array cookie
      var a = prod_id;
      var b = title;
      var c = descr;
      var d = price;
      var e = qty;
      
      if (xv==0){
      var productsArr = [
          {'prod_id' : a,'title' : b, 'descript' : c,'price' : d, 'qty' : e}
        ];
    }
    else {
        var productsArr = JSON.parse(getCartCount("products"));
        productsArr.push(
            {'prod_id' : a,'title' : b, 'descript' : c,'price' : d, 'qty' : e}
        );
    }
    
      var prodArrCook = JSON.stringify(productsArr);
      
      document.cookie = "products="+prodArrCook+"";
      console.log(prodArrCook);
      //----------------------------

      xv=+xv + +e;



      document.cookie ="cartCount="+xv+"";
      $.cookie("cartCount", xv);
      console.log(xv);
      return xv;
  }
    function resetcart(){
    //   document.cookie = "\""+item+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
       document.cookie = "cartCount=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=../;";
       document.cookie = "products=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=../;";

    }
  
    function getCartCount(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
              c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
          }
      }
      return "";
   }
   function loadCart(){
    var x = getCartCount("cartCount");
    // Check browser support
      if (typeof(Storage) !== "undefined") {
          // Store
          if (typeof(x) == "undefined" || isNaN(x)){
            document.cookie = "cartCount = 0";
            x = getCartCount("cartCount");
            console.log(x);
          }
          x = getCartCount("cartCount");
          document.cookie ="cartCount="+x+"";
          console.log(x);
          
      } else {
          console.log("Sorry, your browser does not support Web Storage...");
      }
  
    return x;
   }
  