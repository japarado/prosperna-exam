<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
		if(!$request->session()->get('from-session-info-screen'))
		{
			return redirect(route('register'));
		}
        $request->validate([
			'paypal-response-hidden' => 'required',
        ]);
		$paypal_response = json_decode($request->input('paypal-response-hidden'));

		DB::transaction(function() use ($request, $paypal_response) {
			Auth::login($user = User::create([
				'name' => $request->session()->get('name'),
				'email' => $request->session()->get('email'),
				'password' => Hash::make($request->session()->get('password')),
			]));


			$subscription = new Subscription([
				'name' => 'Basic Website Subscription',
				'order_id' => $paypal_response->orderID,
				'payment_id' => $paypal_response->paymentID,
				'billing_token' => $paypal_response->billingToken,
				'subscription_id' => $paypal_response->subscriptionID,
				'facilitator_access_token' => $paypal_response->facilitatorAccessToken
			]);

			$user->subscriptions()->save($subscription);

			event(new Registered($user));
		});


        return redirect(RouteServiceProvider::HOME);
    }

	public function pay(Request $request)
	{
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

		$name = $request->input('name');
		$email = $request->input('email');
		$password = $request->input('password');

		$request->session()->flash('from-register-info-screen', true);
		$request->session()->flash('name', $name);
		$request->session()->flash('email', $email);
		$request->session()->flash('password', $password);

		$context = [
			'name' => $name,
			'email' => $email,
			'password' => $password
		];

		return view('auth.pay', $context);
	}
}
