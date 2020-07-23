<?php require_once("../includes/braintree_init.php"); ?>

<html>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<body>
 	
	<div class="wrapper">
        <center>
		
	    <header>
        <h2>Domenic's eCommerce Demo</h2>
        </header>
		
		</center> 		
		
	    <p><center><div class="alert alert-danger" role="alert">
         <b>FYI:</b> This Page Is For Test Purposes Only!
         </div></p></center>        
		
		
		<div class="checkout container">
          <!-- Button trigger modal -->
            <p><center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
             Drop-In UI Demo
            </button></center></p>

             <!-- Modal -->
             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
             <div class="modal-content">
             <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Domenic's eCommerce Demo</h5>
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             </div>
			 
			 <div class="modal-body">
             <form method="post" id="payment-form" action="<?php echo $baseUrl;?>checkout.php">
                    <section>
					<label for="amount">
                        <b><span class="input-label">Transaction Amount</span></b>
                        <div class="input-wrapper amount-wrapper">
                            <input id="amount" name="amount" type="tel" min="1" placeholder="" value="100">
                        </div>
                    </label>
					
                    <p><div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div></p>
					
                 </div>
                </section>
                <div class="modal-footer">
                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button class="btn btn-success" type="submit"><span>Process Transaction</span></button>
                </div>
                </div>
                </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.23.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "<?php echo($gateway->ClientToken()->generate()); ?>"; //Generates Client Auth

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
    flow: 'checkout',
    amount: '100.00',
    currency: 'AUD'
  },
		card: {       // Adding CardHolderName field to collect details
        cardholderName: {
        required: true
    }
  },
        }, function (createErr, instance) {
          if (createErr) {
            alert('Create Error', createErr); //Making the error alert instead of console-logging
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                alert('Request Payment Method Error', err); //Making the error alert instead of console-logging
                return;
              }

              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>
    <script src="javascript/demo.js"></script>
</body>
</html>
