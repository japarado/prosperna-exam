<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form  action="{{ route('register') }}" method="POST" id="js-registration-form">
			<input type="hidden" name="paypal-response-hidden" id="js-paypal-response-hidden"/>
			@csrf
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                {{-- <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="Manta Maria" required autofocus /> --}}
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                {{-- <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="maria@mail.com" required /> --}}
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                {{-- <x-input id="password" class="block mt-1 w-full" --}}
                {{--                 type="password" --}}
                {{--                 name="password" --}}
                {{--                 required autocomplete="new-password" value="password123" /> --}}
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                {{-- <x-input id="password_confirmation" class="block mt-1 w-full" --}}
                {{--                 type="password" --}}
                {{--                 name="password_confirmation" value="password123" required /> --}}
                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4" id="js-user-info-submit">
                    {{ __('Register') }}
                </x-button>
            </div>

            <div class="flex items-center justify-end mt-4 hidden" id="js-paypal-buttons-container">
				<div id="js-paypal-buttons" class="container"></div>
			</div>
        </form>
    </x-auth-card>
	@section('guest-layouts.scripts')
		  <script src="https://www.paypal.com/sdk/js?client-id={{ env("PAYPAL_SANDBOX_CLIENT_ID") }}&vault=true"></script>
		  <script src="{{ asset('js/pages/auth/register.js') }}"></script>
	@stop
</x-guest-layout>
