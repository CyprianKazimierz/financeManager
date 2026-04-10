<x-layouts.welcome>
    <div class="text-center w-full h-full lg:text-7xl md:text-5xl text-3xl md:mt-16 mt-7">
        <h1 class="font-bold">{{ __('home.titleOne') }}</h1>
        <h1 class="text-[var(--color-primary)] font-bold">{{ __('home.titleTwo') }}</h1>

        <p class="text-gray-600 text-center mt-2 lg:mt-7 text-sm md:text-xl lg:text-2xl w-3/4 mx-auto">
            {{ __('home.titleText') }}
        </p>

        <div class="flex flex-col lg:flex-row  justify-center gap-5 mt-7 px-6">
            <flux:button class="btn-start !font-bold lg:text-lg md:text-md text-sm w-full lg:w-fit py-4 px-8">
                {{ __('home.register') }}
            </flux:button>
            <flux:button variant="filled" class="btn-login-hover lg:text-lg md:text-md text-sm py-4 w-full lg:w-fit px-8">
                {{ __('home.functions') }}</flux:button>
        </div>
    </div>
</x-layouts.welcome>
