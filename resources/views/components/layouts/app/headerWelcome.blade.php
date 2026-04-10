<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen">
    <flux:header container class="sticky top-0 z-50 border-b backdrop-blur"
        style="
            border-color: var(--color-border); 
            background: color-mix(in oklab, var(--color-card) 90%, transparent);
        ">

        <!-- MOBILE -->
        <flux:sidebar.toggle class="md:hidden me-5" icon="bars-2" inset="left" />
        <flux:spacer class="md:hidden" />
        <!-- LOGO -->
        <a href="{{ url('/') }}" class="flex items-center gap-3" wire:navigate>
            <x-app-logo />
        </a>
        <flux:spacer />
        <!-- NAV DESKTOP -->
        <flux:navbar class="ml-10 max-md:hidden me-2">
            @guest
                <a href="{{ route('login') }}" wire:navigate class="!bg-gray-100 rounded-lg">
                    <flux:button variant="filled"
                        class="transition-all !text-black !font-bold outline-black duration-200 btn-login-hover">
                        {{ __('home.login') }}
                    </flux:button>
                </a>
            @endguest
        </flux:navbar>



        <!-- RIGHT -->
        <flux:navbar class="space-x-1">
            <!-- DARK MODE -->
            <flux:tooltip content="{{ __('changeTheme') }}">
                <flux:navbar.item icon="moon" onclick="document.documentElement.classList.toggle('dark')"
                    class="!text-[color:var(--color-foreground)]" />
            </flux:tooltip>
        </flux:navbar>
    </flux:header>

    <!-- SIDEBAR MOBILE -->
    <flux:sidebar stashable sticky class="md:hidden border-r"
        style="border-color: var(--color-border); background: var(--color-card);">

        <flux:sidebar.toggle icon="x-mark" />
        <flux:navlist variant="outline">

            @guest
                <flux:navlist.item href="{{ route('login') }}">Iniciar sesión</flux:navlist.item>
                <flux:navlist.item href="{{ route('register') }}">Registrarse</flux:navlist.item>
            @endguest
        </flux:navlist>
    </flux:sidebar>


    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        {{ $slot }}
    </main>

    @fluxScripts

</body>

</html>
