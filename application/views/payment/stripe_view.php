<!DOCTYPE html>
<html lang="en">
<body>
<div class='web'>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
  Stripe.setPublishableKey('pk_test_3e5mg8z7bSVkZuxqh4Pj7ls0');
</script>
<form action="<?php echo site_url('Stripe_payment/checkout');?>" method="POST">
<script src="https://checkout.stripe.com/checkout.js"
class="stripe-button"
data-key="pk_test_3e5mg8z7bSVkZuxqh4Pj7ls0"
data-image="your site image"
data-name="w3code.in"
data-description="Demo Transaction ($100.00)"
data-amount="10000" />
</script>
</form>

</div>
</body>
</html>