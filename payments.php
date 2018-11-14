<?php 
require "dbconn.php";
$sql = "SELECT * FROM payments";
$result = $conn->query($sql);
?>
<div class="col-sm-8 col-sm-offset-2 text-center">
    <div class="well">
    <?php 
    if (!isset($_GET['editMethods'])){
        
        echo "<a class='pull-right' href='admin.php?payments=true&editMethods=true'><span class='glyphicon glyphicon-pencil' ></span>&nbsp&nbspEdit Methods</a><br/>";
    }
    ?>
        <ul class="list-group">
        <table width="90%">
            <thead>
                <tr>
                    <th>Enabled?</th>
                    <th class="text-center">Payment Name</th>
                </tr>
            </thead>
            <tbody>
            <form role="form" action="updatePayments.php" method="get">
                <?php
                //---------------get payment methods--------------
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            if ($row["paymentActive"] == 1){
                                $PmtActive= "checked";
                            }
                            else {
                                $PmtActive="unchecked";
                            }
                        echo "<tr><td width='10%'><input type='checkbox' class=checkbox pull-left' name='".$row["paymentID"]."_method' ". $PmtActive ." ";
                        if (!isset($_GET['editMethods'])){echo "disabled";};
                        echo "></td><td width='70%'><li class='list-group-item' >".$row["paymentName"]."</li></td></tr>";
                        }   
                    }
                    $conn->close();
                    if (isset($_GET['editMethods'])){  
                        echo "<button type='submit' class='btn btn-default pull-right'><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp&nbspSave</button>";
                    }
                //----------end get payment methods---------------
                ?>
                </form>
            </tbody>
        </table>


        </ul>
    </div>
</div>


