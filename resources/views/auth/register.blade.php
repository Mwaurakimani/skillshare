<x-guest-layout>
    <x-Cards.auth-card>
        <!-- Validation Errors -->
        <x-Errors.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
            <div>
                <x-Elem.label for="name" :value="__('Name')"/>

                <x-Elem.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                         autofocus/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-Elem.label for="email" :value="__('Email')"/>

                <x-Elem.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
            </div>

            <!-- Account type -->
            <div class="mt-4">
                <x-Elem.label for="account_type" :value="__('Account Type')"/>

                <x-Elem.input-select id="account_type" class="block mt-1 w-full" type="select" name="account_type" :value="old('account_type')" required/>
            </div>

            <!-- location -->
            <div class="mt-4">
                <x-Elem.label for="location" :value="__('Location')"/>

                <x-Elem.input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-Elem.label for="password" :value="__('Password')"/>

                <x-Elem.input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-Elem.label for="password_confirmation" :value="__('Confirm Password')"/>

                <x-Elem.input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-Elem.button class="ml-4">
                    {{ __('Register') }}
                </x-Elem.button>
            </div>
        </form>
    </x-Cards.auth-card>
</x-guest-layout>
