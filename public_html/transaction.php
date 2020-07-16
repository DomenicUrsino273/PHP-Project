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
            $header = "Transaction Approved";
            $icon = "success";
        } else {
            $header = "Transaction Failed";
            $icon = "fail";
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


<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Transaction ID</td>
      <td>Type</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><?php echo($transaction->id)?></td>
      <td><?php echo($transaction->type)?></td>
    </tr>
  </tbody>
</table>


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Transaction Response</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Payment Details</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td>Transaction ID:</td>
                        <td><?php echo($transaction->id)?></td>
                    </tr>
                    <tr>
                        <td>Type:</td>
                        <td><?php echo($transaction->type)?></td>
                    </tr>
                    <tr>
                        <td>Amount:</td>
                        <td>$ <?php echo($transaction->amount)?></td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td><?php echo($transaction->status)?></td>
                    </tr>
                    <tr>
                        <td>Created At:</td>
                        <td><?php echo($transaction->createdAt->format('Y-m-d H:i:s'))?></td>
                    </tr>
                    <tr>
                        <td>Updated At:</td>
                        <td><?php echo($transaction->updatedAt->format('Y-m-d H:i:s'))?></td>
                    </tr>
                </tbody>
            </table>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td>Token:</td>
                        <td><?php echo($transaction->creditCardDetails->token)?></td>
                    </tr>
                    <tr>
                        <td>Card Bin Range:</td>
                        <td><?php echo($transaction->creditCardDetails->bin)?></td>
                    </tr>
                    <tr>
                        <td>Last 4 Digits:</td>
                        <td><?php echo($transaction->creditCardDetails->last4)?></td>
                    </tr>
                    <tr>
                        <td>Card Type:</td>
                        <td><?php echo($transaction->creditCardDetails->cardType)?></td>
                    </tr>
                    <tr>
                        <td>Exp. Date:</td>
                        <td><?php echo($transaction->creditCardDetails->expirationDate)?></td>
                    </tr>
                    <tr>
                        <td>CardHolder Name:</td>
                        <td><?php echo($transaction->creditCardDetails->cardholderName)?></td>
                    </tr>
                    <tr>
                        <td>CardHolder Location:</td>
                        <td><?php echo($transaction->creditCardDetails->customerLocation)?></td>
                    </tr>
                </tbody>
            </table>

  </div>
</div>
 


</body>
</html>
