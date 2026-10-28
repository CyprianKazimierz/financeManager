<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string',
        ]);

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());
            Flux::toast(heading: __('login.userNotFound'), text: __('login.textError'), variant: 'danger', duration: 3000);
            return;
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('login.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6">

    <x-auth-header title="{{ __('login.title') }}" titleTwo="{{ __('login.titleTwo') }}"
        description="{{ __('login.subTitle') }}" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <div class="flex justify-center">
        <button class="gsi-material-button">
            <div class="gsi-material-button-state"></div>
            <div class="gsi-material-button-content-wrapper">
                <div class="gsi-material-button-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                        xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                        <path fill="#EA4335"
                            d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z">
                        </path>
                        <path fill="#4285F4"
                            d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z">
                        </path>
                        <path fill="#FBBC05"
                            d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z">
                        </path>
                        <path fill="#34A853"
                            d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z">
                        </path>
                        <path fill="none" d="M0 0h48v48H0z"></path>
                    </svg>
                </div>
                <span class="gsi-material-button-contents">{{ __('login.googleButtonLogin') }}</span>
                <span style="display: none;">{{ __('login.googleButtonLogin') }}</span>
            </div>
        </button>
    </div>

    <flux:separator text="{{ __('login.o') }}" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <div class="flex flex-col justify-center">
            <label for="email" class="text-sm text-center">{{ __('login.email') }}</label>
            <flux:input wire:model="email" type="email" name="email" id="email" class="mt-3" required
                autofocus autocomplete="email" placeholder="email@example.com" />

        </div>

        <!-- Password -->
        <div class="flex flex-col justify-center">
            <label for="password" class="text-sm text-center">{{ __('login.password') }}</label>
            <flux:input wire:model="password" type="password" name="password" class="mt-3" required
                autocomplete="current-password" placeholder="Password" />
        </div>

        <div class="w-full mt-3">
            <flux:button variant="primary" class="w-full" type="submit">{{ __('login.signIn') }}</flux:button>
        </div>
    </form>

    <div
        class="space-x-1 flex flex-col md:flex-row gap-10 md:gap-1 md:justify-between w-full text-center text-sm text-zinc-600 dark:text-zinc-400">
        <div>
            @if (Route::has('password.request'))
                <x-text-link href="{{ route('password.request') }}">
                    {{ __('login.forgotpass') }}
                </x-text-link>
            @endif
        </div>
        <div>
            {{ __('login.Noacount') }}
            <x-text-link href="{{ route('register') }}">{{ __('login.singUp') }}</x-text-link>
        </div>
    </div>

</div>
