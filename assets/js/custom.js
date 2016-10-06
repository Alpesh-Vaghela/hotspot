$(document).ready(function(){
	$('#payment_login').on('click', '.plan-select-btn', function(){
		var plan_id = $(this).data('plan-id');
		var data = { 'plan_id': plan_id};
		
		$.ajax({ 
			url: "/welcome/get_plan_data",
			type: "POST",
			dataType: 'json',
			data: data,
			beforeSend: function() {;
			},
			success: function(data) {
				if(data.status == 1) {
					
					var plan = data.plan;
					var title = 'Plan ' + plan.title + ': ' + plan.price + ' EUR (download: ' 
						+ plan.max_down + '' + plan.max_down_unit + ', upload: '+ plan.max_up + '' 
						+ plan.max_up_unit +')';
					
					
					$('#payment_login .plan-title').text(title);
					var paypal_form = $('#payment_login #paypal-form');
					paypal_form.find('input[name="item_name"]').val(title);
					paypal_form.find('input[name="amount"]').val(plan.price);

					$('#payment_login .plans-container').hide();
					$('#payment_login .payment-container').show();
				}else if(data.status == 0) {
					alert(data.message);
				}
			},
			complete: function() {
			}
		})
	});
	
	$('#payment_login .payment-container .return-btn').on('click', function(){
		$('#payment_login .payment-container').hide();
		$('#payment_login .plans-container').show();
	})
});

