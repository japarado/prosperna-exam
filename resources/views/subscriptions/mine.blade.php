<x-app-layout>
	@section('layouts.title', 'Dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My subscription') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					<table class="border-collapse border table-auto w-auto">
						<thead>
							<tr>
								<th class="border border-green-600">Plan Name</th>
								<th class="border border-green-600">Subscription ID</th>
								<th class="border border-green-600">Last Payment</th>
								<th  class="border border-green-600">Next Billing</th>
								<th class="border border-green-600">Amount Paid</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="border border-green-600">{{ $user->subscription->name }}</td>
								<td class="border border-green-600">{{ $user->subscription->subscription_id }}</td>
								<td class="border border-green-600">{{ $last_payment_date }}</td>
								<td class="border border-green-600">{{ $next_billing_date }}</td>
								<td class="border border-green-600">{{ $payment_amount }} {{ $currency }}</td>
							</tr>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
