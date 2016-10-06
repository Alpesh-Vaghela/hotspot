<!DOCTYPE html>
<html lang="en">
<body>
<div class='web'>
<form action="<?php echo site_url('Stripe_payment/checkout');?>" method="POST">
<script src="https://checkout.stripe.com/checkout.js"
class="stripe-button"
data-key="sk_test_P8MOWskuNC1klwukMH6HmvbI"
data-image="Image path"
data-name="Sandeep"
data-description="Demo Transaction ($100.00)"
data-amount="10000" />
</script>
</form>
</div>
</body>
</html>