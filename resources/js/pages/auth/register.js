import axiosInstance from "../../services/instance";

const nameField = document.getElementById("name");
const emailField = document.getElementById("email");
const passwordField = document.getElementById("password");
const passwordConfirmationField = document.getElementById("password_confirmation");
const submitButton = document.getElementById("js-user-info-submit");

const form = document.getElementById("js-registration-form");

paypal.Buttons({
	createSubscription: (data, actions) => 
	{
		return actions.subscription.create({
			"plan_id": "P-7YY87840HY308120GL7VI6XI",
		});
	},

	onApprove: (data, actions) => 
	{
		console.table(data)
		document.getElementById("js-paypal-response-hidden").value = JSON.stringify(data);
		document.getElementById("js-registration-form").submit();
	}
}).render("#js-paypal-buttons");

submitButton.addEventListener("click", async (e) => 
{
	e.preventDefault();

	let response;
	try 
	{
		response = await axiosInstance.post("register/validate",
			{
				name: nameField.value,
				email: emailField.value,
				password: passwordField.value,
				password_confirmation: passwordConfirmationField.value
			});
	}
	catch(e)
	{
		response = e.response;
	}

	if(response.status === 200)
	{
		disableUserInfoInputs();
		renderPayPalButtons();
	}
	else 
	{
		form.submit();
	}
});

function renderPayPalButtons()
{
	document.getElementById("js-paypal-buttons-container").classList.remove("hidden");
}

function disableUserInfoInputs()
{
	// nameField.disabled = true;
	nameField.readonly = true;

	// emailField.disabled = true;
	emailField.readonly = true;

	// passwordField.disabled = true;
	passwordField.readonly = true;

	// passwordConfirmationField.disabled = true;
	passwordConfirmationField.readonly = true;

	submitButton.disabled = true;
}
