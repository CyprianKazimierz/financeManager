<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')

</head>

<body
    class="min-h-screen bg-[var(--color-background)] antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div
        class="dark:bg-neutral-800 bg-neutral-100 flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div
            class="flex w-full max-w-sm md:max-w-lg flex-col border-t-4 border-[var(--color-primary)]  gap-2 shadow-xl/30 rounded-xl p-12">
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <flux:tooltip content="{{ __('login.goHome') }}">
                    <span class="flex h-16 w-18 mb-1 items-center justify-center rounded-md text-black dark:text-white">
                        <x-app-logo-icon class="size-12 fill-current text-[var(--color-primary-hover)]" />
                    </span>
                </flux:tooltip>
            </a>
            <div class="flex flex-col gap-6">
                {{ $slot }}
            </div>
        </div>
    </div>
    @persist('toast')
        <flux:toast />
    @endpersist
    @fluxScripts

</body>

</html>
