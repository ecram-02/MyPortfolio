<x-guest-layout>
    <style>
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-primary, #f8f9fa);
            padding: 2rem 1rem;
        }

        /* Override Jetstream card styles */
        .auth-wrapper .bg-white {
            background: var(--bg-primary, #ffffff) !important;
            border: 1px solid var(--border-light, #e5e7eb) !important;
            border-radius: var(--border-radius, 12px) !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .dark .auth-wrapper .bg-white {
            background: #1a1a2e !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        .dark .auth-wrapper .dark\:bg-gray-800 {
            background: #1a1a2e !important;
        }

        /* Input fields */
        .auth-wrapper input[type="email"],
        .auth-wrapper input[type="password"] {
            background: var(--bg-secondary, #f3f4f6) !important;
            border: 1px solid var(--border-light, #e5e7eb) !important;
            border-radius: var(--border-radius, 8px) !important;
            color: var(--text-primary, #111827) !important;
            padding: 0.625rem 0.75rem !important;
            font-size: 0.875rem !important;
            transition: border-color 0.2s, box-shadow 0.2s !important;
            width: 100% !important;
        }

        .auth-wrapper input[type="email"]:focus,
        .auth-wrapper input[type="password"]:focus {
            border-color: var(--primary, #4f46e5) !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important;
            outline: none !important;
        }

        .dark .auth-wrapper input[type="email"],
        .dark .auth-wrapper input[type="password"] {
            background: rgba(30, 30, 30, 0.8) !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #e5e7eb !important;
        }

        /* Checkbox */
        .auth-wrapper input[type="checkbox"] {
            accent-color: var(--primary, #4f46e5) !important;
            border: 1px solid var(--border-light, #e5e7eb) !important;
            border-radius: 4px !important;
        }

        /* Button */
        .auth-wrapper button[type="submit"],
        .auth-wrapper .inline-flex.items-center.px-4.py-2 {
            background: linear-gradient(135deg, var(--primary, #4f46e5), var(--secondary, #7c3aed)) !important;
            border: none !important;
            border-radius: var(--border-radius, 8px) !important;
            color: #fff !important;
            padding: 0.625rem 1.25rem !important;
            font-size: 0.875rem !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.2s !important;
        }

        .auth-wrapper button[type="submit"]:hover,
        .auth-wrapper .inline-flex.items-center.px-4.py-2:hover {
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
            opacity: 0.95 !important;
        }

        /* Labels */
        .auth-wrapper label:not([for="remember_me"]) {
            color: var(--text-primary, #111827) !important;
            font-weight: 600 !important;
            font-size: 0.875rem !important;
        }

        .dark .auth-wrapper label:not([for="remember_me"]) {
            color: #e5e7eb !important;
        }

        /* Auth card logo area */
        .auth-wrapper .shrink-0 {
            margin-bottom: 1.5rem !important;
        }

        /* Error styling */
        .auth-wrapper .text-red-600 {
            color: #ef4444 !important;
        }

        .auth-wrapper .border-red-300 {
            border-color: #ef4444 !important;
        }

        /* Focus ring */
        .auth-wrapper .focus\:ring-indigo-500:focus {
            --tw-ring-color: var(--primary, #4f46e5) !important;
        }

        /* Success message */
        .auth-wrapper .text-green-600 {
            color: #10b981 !important;
        }

        /* Remember me text */
        .auth-wrapper span.text-sm {
            color: var(--text-secondary, #6b7280) !important;
        }

        .dark .auth-wrapper span.text-sm {
            color: #9ca3af !important;
        }

        /* Forgot password link */
        .auth-wrapper a.underline {
            color: var(--text-secondary, #6b7280) !important;
            text-decoration: underline !important;
        }

        .auth-wrapper a.underline:hover {
            color: var(--primary, #4f46e5) !important;
        }

        .dark .auth-wrapper a.underline {
            color: #9ca3af !important;
        }

        .dark .auth-wrapper a.underline:hover {
            color: #818cf8 !important;
        }

        @media (max-width: 640px) {
            .auth-wrapper {
                padding: 1rem;
            }
        }
    </style>

    <div class="auth-wrapper">
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm" style="color: #10b981;">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2" 
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ms-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>