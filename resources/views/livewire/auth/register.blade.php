<?php

use App\Models\User;
use App\Models\UserType;
use App\Models\EmailOtp;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $surname = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $locale = '';
    public string $monetary_currency = '';
    public string $userType = '';
    public $userTypes;

    //Get data from User Types table
    public function mount()
    {
        $this->userTypes = UserType::orderBy('id', 'desc')->get();
    }

    /**
     * Handle an incoming registration request.
     */
    public function register()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'min:8', 'string', Rules\Password::defaults()],
            'locale' => ['required', 'string'],
            'monetary_currency' => ['required', 'string'],
        ]);

        /*
         * Determinar el tipo de usuario
         */

        $defaultUserType = UserType::where('name', 'usuario')->firstOrFail();

        if (Auth::check() && Auth::user()->userType->name === 'admin') {
            // El admin puede elegir el tipo
            $validated['userType'] = $this->userType;
        } else {
            // Cualquier otro usuario será usuario normal
            $validated['userType'] = $defaultUserType->id;
        }

        dd($validated);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        $this->sendOTP($user);

        //return redirect()->route('verification.notice')->with('email', $user->email);
    }

    private function sendOTP(User $user)
    {
        $resend = Resend::client(config('services.resend.key'));

        //generate Code
        $code = random_int(100000, 999999);
        //save it in bbdd
        EmailOtp::create([
            'user_id' => $user->id,
            'code' => Hash::make($code),
            'expires_at' => now()->addMinutes(10),
        ]);
        //send mail
        $resend->emails->send([
            'from' => 'Resend <onboarding@resend.dev>',
            'to' => [$user->email],
            'subject' => 'Tu código de verificación - FinanceManager',
            'html' =>
                "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Verifica tu cuenta</title>
        </head>

        <body style='
            margin: 0;
            padding: 0;
            background-color: #f4f4f5;
            font-family: Arial, Helvetica, sans-serif;
            color: #18181b;
        '>

            <div style='
                max-width: 600px;
                margin: 40px auto;
                background-color: #ffffff;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            '>

                <!-- Header -->
                <div style='
                    padding: 30px;
                    text-align: center;
                    background-color: #18181b;
                '>
                    <h1 style='
                        margin: 0;
                        color: #ffffff;
                        font-size: 28px;
                    '>
                        Finance<span style='color: #6366f1;'>Manager</span>
                    </h1>
                </div>

                <!-- Content -->
                <div style='padding: 40px 30px; text-align: center;'>

                    <h2 style='
                        margin-top: 0;
                        margin-bottom: 15px;
                        font-size: 24px;
                    '>
                        Verifica tu cuenta
                    </h2>

                    <p style='
                        color: #52525b;
                        font-size: 16px;
                        line-height: 1.6;
                        margin-bottom: 30px;
                    '>
                        Gracias por registrarte en FinanceManager.
                        Utiliza el siguiente código para verificar tu dirección de correo electrónico:
                    </p>

                    <!-- OTP -->
                    <div style='
                        display: inline-block;
                        padding: 18px 30px;
                        background-color: #f4f4f5;
                        border: 1px solid #e4e4e7;
                        border-radius: 10px;
                        margin-bottom: 25px;
                    '>
                        <span style='
                            font-size: 36px;
                            font-weight: bold;
                            letter-spacing: 8px;
                            color: #6366f1;
                        '>
                            {$code}
                        </span>
                    </div>

                    <p style='
                        color: #71717a;
                        font-size: 14px;
                        line-height: 1.5;
                    '>
                        Este código es válido durante <strong>10 minutos</strong>.
                        <br>
                        Si no has creado una cuenta en FinanceManager,
                        puedes ignorar este correo.
                    </p>

                </div>

                <!-- Footer -->
                <div style='
                    padding: 20px 30px;
                    background-color: #fafafa;
                    border-top: 1px solid #e4e4e7;
                    text-align: center;
                '>
                    <p style='
                        margin: 0;
                        color: #a1a1aa;
                        font-size: 12px;
                    '>
                        © " .
                date('Y') .
                " FinanceManager. Todos los derechos reservados.
                    </p>
                </div>

            </div>

        </body>
        </html>
    ",
        ]);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header title="{{ __('register.title') }}" titleTwo="{{ __('register.titleTwo') }}"
        description="{{ __('register.subTitle') }}" />

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
                <span class="gsi-material-button-contents">{{ __('register.googleButtonLogin') }}</span>
                <span style="display: none;">{{ __('register.googleButtonLogin') }}</span>
            </div>
        </button>
    </div>

    <flux:separator text="{{ __('register.o') }}" />

    <form wire:submit="register" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Name -->
        <div class="grid gap-2 col-span-1">
            <flux:input wire:model="name" id="name" label="{{ __('register.name') }}" type="text" name="name"
                required autofocus autocomplete="name" placeholder="{{ __('register.name') }}" />
        </div>

        <!-- Surame -->
        <div class="grid gap-2 col-span-1">
            <flux:input wire:model="surname" id="surname" label="{{ __('register.surname') }}" type="text"
                name="surname" required autofocus autocomplete="surname" placeholder="{{ __('register.surname') }}" />
        </div>

        <!-- Email Address -->
        <div class="grid gap-2 col-span-1 md:col-span-2">
            <flux:input wire:model="email" id="email" label="{{ __('register.email') }}" type="email"
                name="email" required autocomplete="email" placeholder="{{ __('register.email') }}" />
        </div>

        <!-- Password -->
        <div class="grid gap-2 col-span-1 ">
            <flux:input wire:model="password" id="password" label="{{ __('register.password') }}" type="password"
                name="password" required autocomplete="new-password" placeholder="{{ __('register.password') }}" />
        </div>

        <!-- Confirm Password -->
        <div class="grid gap-2 col-span-1 ">
            <flux:input wire:model="password_confirmation" id="password_confirmation"
                label="{{ __('register.repPassword') }}" type="password" name="password_confirmation" required
                autocomplete="new-password" placeholder="{{ __('register.repPassword') }}" />
        </div>

        <div class="grid gap-2 col-span-1">
            <flux:select wire:model="locale" id="locale" name="locale" label="{{ __('register.locale') }}"
                required>
                <flux:select.option value="">{{ __('register.default') }}</flux:select.option>
                <flux:select.option value="EUR">{{ __('register.europ') }}</flux:select.option>
                <flux:select.option value="AMR">{{ __('register.america') }}</flux:select.option>
                <flux:select.option value="ASI">{{ __('register.asia') }}</flux:select.option>
                <flux:select.option value="AFR">{{ __('register.africa') }}</flux:select.option>
                <flux:select.option value="OCE">{{ __('register.oceania') }}</flux:select.option>
            </flux:select>
        </div>

        <div class="grid gap-2 col-span-1">
            <flux:select wire:model="monetary_currency" id="monetary_currency" name="monetary_currency" required
                label="{{ __('register.monetaryCurrency') }}">
                <flux:select.option value="">{{ __('register.default') }}</flux:select.option>
                <flux:select.option value="eu_EU">{{ __('register.euEU') }}</flux:select.option>
                <flux:select.option value="am_AM">{{ __('register.amAM') }}</flux:select.option>
                <flux:select.option value="as_AS">{{ __('register.asAS') }}</flux:select.option>
                <flux:select.option value="af_AF">{{ __('register.afAF') }}</flux:select.option>
                <flux:select.option value="oc_OC">{{ __('register.ocOC') }}</flux:select.option>
            </flux:select>
        </div>
        @if (Auth::check() && Auth::user()->userType->name === 'admin')

            <div class="grid gap-2 col-span-1 md:col-span-2">
                <flux:select wire:model="userType" id="userType" name="{{ __('register.userType') }}"
                    label="userType">
                    @foreach ($userTypes as $u)
                        <flux:select.option value="{{ $u->id }}">{{ $u->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>
        @endif

        <div class="flex items-center justify-end col-span-1 md:col-span-2">
            <flux:button wire:click="register" type="submit" variant="primary" class="w-full">
                {{ __('register.createAccount') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('register.accountAlready') }}
        <x-text-link href="{{ route('login') }}">{{ __('register.singIn') }}</x-text-link>
    </div>
</div>
