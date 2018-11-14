<header>
<?php 
    $pg = basename($_SERVER['PHP_SELF']);
?>
<div id="header" class="navbar navbar-default navbar-static-top">
<a href="admin.php"><button class="btn btn-sm"><span class="glyphicon glyphicon-briefcase"></span> Admin</button></a><br>

<!-- cartbutton -->
<a href="cart.php" style="font-size:16px;color:#000000;padding-right:50px" class="pull-right <?php if($pg == 'admin.php'||$pg == 'checkout.php'){echo 'hidden';} ?>" id="viewCart"><span class="glyphicon glyphicon-shopping-cart" style="font-size:20px;color:#000000;"></span>&nbspView Cart</a>

  <div class="navbar-header"><a class="navbar-brand" href="#"></a>
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </div>
<img src="images/hcfull3.png" class="img-fluid center-block"/>

<div id="navBar" class="collapse navbar-collapse">
  <ul class="nav navbar-nav">
   <li class="<?php if($pg == 'index.php'){echo 'active';}if($pg == 'admin.php'||$pg == 'checkout.php'){echo 'hidden';} ?>"><a href="index.php"><h4>Home</h4></a></li>
   <li class="<?php if($pg == 'shop.php'){echo 'active';}if($pg == 'admin.php'||$pg == 'checkout.php'){echo 'hidden';} ?>"><a href="shop.php"><h4>Shop</h4></a></li>
   <!-- <li class="<?php if($pg == 'about.php'){echo 'active';}if($pg == 'admin.php'||$pg == 'checkout.php'){echo 'hidden';} ?>"><a href="about.php"><h4>About</h4></a></li> -->
  </ul>
</div>
</div>

</header>

