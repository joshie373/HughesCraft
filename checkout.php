<!DOCTYPE html>
<html>
  <head>
    <?php include "linkRefs.php";
      //----------check if BT active------------
   function getBTstatus(){
    include "dbconn.php";
    $sql = "SELECT paymentActive FROM payments WHERE paymentID='101'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
        if ($row["paymentActive"]== 1){
          return true;
        }
        else {
          return false;
        }
    $conn->close();
   }
 //--------end BT Check-----------------------

    ?>
    <title>HughesCraft-Checkout</title>

  </head>
  <?php include "header.php"?>
  <body>
  <div class="row">
    <div class="col-md-6" style="border-style:solid;margin:30px">
        <div class="panel-group text-center" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading" style="padding:0;margin:0;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                        <button id="custInfoBtn" class="btn btn-primary" style="width:90%; margin:6px;">Customer Information</button>
                    </a>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="col-sm-6 col-sm-offset-3 text-left">
                            <div class="well">
                                <form role="form" id="custForm" method="POST" action="customer_submit.php">
                                    <div class="form-group">
                                        <label for="custForm_fName">First Name</label>
                                        <input type="text" class="form-control" name="custForm_fName" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="custForm_lName">Last Name</label>
                                        <input type="text" class="form-control" name="custForm_lName" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="custForm_street">Street</label>
                                        <input type="text" class="form-control" name="custForm_street" placeholder="1234 Street Rd">
                                    </div>
                                    <div class="form-group">
                                        <label for="custForm_city">City</label>
                                        <input type="text" class="form-control" name="custForm_city" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                        <label for="custForm_state">State</label>
                                        <select name="custForm_state">
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="DC">District Of Columbia</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="custForm_zip">Zip</label>
                                        <input type="text" class="form-control" name="custForm_zip" placeholder="Zip Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="custForm_email">Email</label>
                                        <input type="email" class="form-control" name="custForm_email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="custForm_phone">Phone Number</label>
                                        <input type="phone" class="form-control" name="custForm_phone" placeholder="(123)-456-789">
                                    </div>
                                            <input id="custFormSubmit" type="button" class="btn btn-default pull-right" onclick="submitDetailsForm();" style="background-color:#209972;color:#ffffff;" value="Next"></input>
                                </form>
                                <script src="checkout.js"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" style="padding:0;margin:0;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                        <button class="btn btn-primary" style="width:90%; margin:6px;">Shipping</button>
                    </a>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                    <div class="col-sm-6 col-sm-offset-3 text-left">
                            <div class="well">
                                <form role="form" id="ship_form" action="" method="POST">
                                    <div class="form-group">
                                        <div class="radio">
                                            <label><input type="radio" name="ship" value="5.00" checked>Flat Fee $5.00</label>
                                        </div>
                                    </div>

                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                            <button id="colnextShip" type="submit" name="ship" class="btn btn-default pull-right" style="background-color:#209972;color:#ffffff;">Next</button>
                                    </a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" style="padding:0;margin:0;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                        <button class="btn btn-primary" style="width:90%; margin:6px;">Payment</button>
                    </a>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div id="paymentPanelBody" class="panel-body">

                        <div class="col-sm-10 col-sm-offset-1 text-left">
                            <div class="well">
                              <p><b>Braintree test card:</b>
                              <br>
                              4005519200000004<br><br></p>
                                <?php
                                if (getBTstatus()){
                                    include "braintreePayment.php";
                                  }
                                  else {
                                    echo "No Payment Method Available";
                                  }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="checkout.js"></script><!-- submits order to db -->
        </div>
        <input type="hidden" id="StoreCustomerId"></input>
    </div> <!-- end left col -->
    <div id="rightCol" class="col-md-4" style="border-style:solid;margin:30px">
        <?php include "checkoutCart.php"; ?>
    </div>
</div>
  </body>

</html>
