
function submitOrderForm() {
    
    $("#orderAmount").val($("#cartTotal").val());
    $("#orderStatus").val("Pending");
    var Orderformdata = $("#orderForm").serialize();
    $.ajax({
        type: "POST",
        url: "order_submit.php",
        data: Orderformdata,
        dataType: 'json',
        //fix this part
        success: function (data) {
            $('#paymentPanelBody').html("Order no. "+data.orderID+" Submitted!");
        }
    });
    
    return false;
}
function setCuId(id){
    var id= id;
    $("#checkoutFormCustId").val(id);//testing
    
}
                                    
function submitDetailsForm() {
    var cuid = "";
    $('#collapse1').collapse("toggle");
    $('#collapse2').collapse("toggle");
    var formdata = $("#custForm").serialize();
    $.ajax({
        type: "POST",
        url: "customer_submit.php",
        data: formdata,
        dataType: 'json',
        //fix this part
        success: function (data) {
            $("#StoreCustomerId").val(data.custId);//working
            cuid = data.custId;
            setCuId(cuid);
            $('#custInfoBtn').html("Customer Information <span class='pull-right'>ID:"+data.custId+"</span>");
        }
    });
    
    return false;
    }