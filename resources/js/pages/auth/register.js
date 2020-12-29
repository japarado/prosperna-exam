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
			alert("Yout have successfully created a subscription", + data.subscriptionID);
		}
	})
	.render("#paypal-button-container");
