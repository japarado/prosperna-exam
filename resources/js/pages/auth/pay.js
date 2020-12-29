paypal
	.Buttons({
		createSubscription: (data, actions) => 
		{
			return actions.subscription.create({
				"plan_id": "P-7YY87840HY308120GL7VI6XI",
			});
		},

		onApprove: (data, actions) => 
		{
			document.getElementById("js-paypal-response-hidden").value = JSON.stringify(data);
			console.table(data);
			document.getElementById("js-payment-form").submit();
		}
	})
	.render("#paypal-button-container");
