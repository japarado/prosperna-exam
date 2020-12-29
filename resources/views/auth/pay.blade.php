<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form  action="{{ route('register') }}" method="POST" id="js-payment-form">
			@csrf
			<input type="hidden" name="paypal-response-hidden" id="js-paypal-response-hidden">
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$name" required autofocus readonly />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$email" required readonly />
            </div>

            <div class="flex items-center justify-end mt-4">
				<div id="paypal-button-container" class="container"></div>
			</div>

            {{-- <div class="flex items-center justify-end mt-4"> --}}
            {{--     <x-button class="ml-4"> --}}
            {{--         {{ __('Register') }} --}}
            {{--     </x-button> --}}
			{{-- </div> --}}

            <div class="flex items-center justify-end mt-4">
				<div id="paypal-button-container"></div>
			</div>
        </form>
    </x-auth-card>
	@section('guest-layouts.scripts')
		  <script src="https://www.paypal.com/sdk/js?client-id={{ env("PAYPAL_SANDBOX_CLIENT_ID") }}&vault=true"></script>
		  <script src="{{ asset('js/pages/auth/pay.js') }}"></script>
	@stop
</x-guest-layout>
