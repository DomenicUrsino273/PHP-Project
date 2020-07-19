<?php  require_once("../includes/braintree_init.php"); ?>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<body>

<?php
    require_once("../includes/header.php");
    if (isset($_GET["id"])) {
        $transaction = $gateway->transaction()->find($_GET["id"]);

        $transactionSuccessStatuses = [
            Braintree\Transaction::AUTHORIZED,
            Braintree\Transaction::AUTHORIZING,
            Braintree\Transaction::SETTLED,
            Braintree\Transaction::SETTLING,
            Braintree\Transaction::SETTLEMENT_CONFIRMED,
            Braintree\Transaction::SETTLEMENT_PENDING,
            Braintree\Transaction::SUBMITTED_FOR_SETTLEMENT
        ];

        if (in_array($transaction->status, $transactionSuccessStatuses)) {
            $header = "Your Transaction Was Approved!";
        } else {
            $header = "Your Transaction Failed!";
        }
    }
?>

<div class="wrapper"> 
    <div class="response container">
        <div class="content">
	   <div class="alert alert-success" role="alert">
       <center><h2><?php echo($header)?></h2></center>
       </div>
        </div>
    </div>
</div>

<!-- Transaction Details trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
 View Transaction Details
</button>

<!-- Transaction Details Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <table width="200" border="1">
  <tbody>
    <tr>
        <td>id</td>
        <td><?php echo($transaction->id)?></td>
    </tr>
    <tr>
     <td>type</td>
      <td><?php echo($transaction->type)?></td>
    </tr>
    <tr>
      <td>amount</td>
      <td><?php echo($transaction->amount)?></td>
    </tr>
    <tr>
       <td>status</td>
        <td><?php echo($transaction->status)?></td>
    </tr>
    <tr>
       <td>created_at</td>
       <td><?php echo($transaction->createdAt->format('Y-m-d H:i:s'))?></td>
    </tr>
    <tr>
      <td>updated_at</td>
      <td><?php echo($transaction->updatedAt->format('Y-m-d H:i:s'))?></td>
    </tr>
    <tr>
     <td>bin</td>
      <td><?php echo($transaction->creditCardDetails->bin)?></td>
    </tr>
    <tr>
       <td>bin</td>
                        <td><?php echo($transaction->creditCardDetails->bin)?></td>
    </tr>
    <tr>
   <td>expiration_date</td>
                        <td><?php echo($transaction->creditCardDetails->expirationDate)?></td>
    </tr>
    <tr>
        <td>bin</td>
                        <td><?php echo($transaction->creditCardDetails->bin)?></td>
    </tr>
    <tr>
      
                        <td>cardholder_name</td>
                        <td><?php echo($transaction->creditCardDetails->cardholderName)?></td>
    </tr>
    
      <tr>
      
                       <td>customer_location</td>
                        <td><?php echo($transaction->creditCardDetails->customerLocation)?></td>
    
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  


                                             
                                                            
                                                                           
                                                                                                         
</body>
</html>
