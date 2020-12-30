<?php

namespace App\Http\Controllers;

use App\Http\Services\PayPalService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
	public function __construct()
	{
		$this->paypalService = new PayPalService();
	}

	private PayPalService $paypalService;

	public function mine()
	{
		$user = User::with('subscription')->where('id', Auth::user()->id)->first();
		$subscription_info = $this->paypalService->getSubscription($user->subscription->subscription_id);
		$plan_info = $this->paypalService->getPlan($subscription_info->plan_id);

		/* dd($subscription_info->billing_info->last_payment->time); */

		/* $date = new Carbon($user->subscription->created_at); */
		/* dd($date->toFormattedDateString()); */

		/* return response()->json([ */
		/* 	'subscription_info' => $subscription_info, */
		/* 	'plan_info' => $plan_info, */
		/* 	'user' => $user */
		/* ]); */

		$context = [
			'user' => $user,
			'last_payment_date' => (new Carbon($subscription_info->billing_info->last_payment->time))->toFormattedDateString(),
			'next_billing_date' => (new Carbon($subscription_info->billing_info->next_billing_time))->toFormattedDateString(),
			'currency' => $subscription_info->billing_info->last_payment->amount->currency_code,
			'payment_amount' => $subscription_info->billing_info->last_payment->amount->value,

			'subscription_info' => $subscription_info,
			'plan_info' => $plan_info
		];
		return view('subscriptions.mine', $context);
	}
}
