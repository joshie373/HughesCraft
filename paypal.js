paypal.Button.render({
  
          // Set your environment
  
          env: 'sandbox', // sandbox | production
  
          // Specify the style of the button
  
          style: {
              layout: 'vertical',  // horizontal | vertical
              size:   'medium',    // medium | large | responsive
              shape:  'rect',      // pill | rect
              color:  'gold'       // gold | blue | silver | black
          },
  
          // Specify allowed and disallowed funding sources
          //
          // Options:
          // - paypal.FUNDING.CARD
          // - paypal.FUNDING.CREDIT
          // - paypal.FUNDING.ELV
  
          funding: {
              allowed: [ paypal.FUNDING.CARD, paypal.FUNDING.CREDIT ],
              disallowed: [ ]
          },
  
          payment: function() {
              return paypal.request.post("paypal/create-payment.php").then(function(data) {
                  return data.id;
              });
  
          },
  
          onAuthorize: function(data) {
            return paypal.request.post("paypal/execute-payment.php", {
                paymentID: data.paymentID,
                payerID:   data.payerID
            }).then(function(data) {
                console.log(data);
                // The payment is complete!
                // You can now show a confirmation message to the customer
                  
                document.location.href = "paymentConfirmation.php?paymentid="+data.id;
  
  
                // document.location.href = "paymentConfirmation.php";
            });
        }
  
      }, '#paypal-button-container');