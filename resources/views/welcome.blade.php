<x-layouts.welcome>
    {{-- Titles, buttons and Big image --}}
    <section class="text-center w-full h-full lg:text-7xl md:text-5xl text-3xl md:mt-16 mt-7">
        <div class="overflow-hidden">
            <div class="relative shake">
                <h1 class="font-bold">{{ __('home.titleOne') }}</h1>
                <h1 class="text-[var(--color-primary)] font-bold">{{ __('home.titleTwo') }}</h1>
            </div>
        </div>


        <p class="text-gray-600 text-center mt-2 lg:mt-7 text-sm md:text-xl lg:text-2xl w-3/4 mx-auto ">
            {{ __('home.titleText') }}
        </p>

        <div class="flex flex-col lg:flex-row  justify-center gap-5 mt-7 px-6">
            <a href="{{ route('register') }}" class="flex items-start">
                <flux:button class="btn-start !font-bold lg:text-lg md:text-md text-sm w-full lg:w-fit py-4 px-8">
                    {{ __('home.register') }}
                </flux:button>
            </a>
            <flux:button variant="filled" onclick="location.href='#features'"
                class="btn-login-hover lg:text-lg md:text-md text-sm py-4 w-full lg:w-fit px-8">
                {{ __('home.functions') }}</flux:button>
        </div>

        <div class="mt-14 flex justify-center relative inline-block">
            <img src="{{ asset('storage/homeIMG.jpg') }}" alt="Finance img" width="1000" height="1000"
                class="shadow-xl h-auto rounded-xl object-cover">
            <div
                class="absolute inset-0 rounded-xl pointer-events-none
        bg-gradient-to-t
        from-[color:var(--color-background)/80]
        via-[color:var(--color-background)/30]
        via-70%
        to-transparent ">
            </div>
        </div>
    </section>

    {{-- Cards --}}
    <section
        class="mt-12 md:mt-24 md:p-24 w-full second-section dark:second-section flex flex-col justify-center text-center"
        id="features">
        <h2 class="text-2xl md:text-3xl font-bold mt-10">{{ __('home.titleFunctions') }}</h2>
        <p class="mt-3 text-md md:text-xl text-gray-500">{{ __('home.subtitleFunction') }}</p>

        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-15 lg:mt-24 mt-5 mb-8 lg:mb-10 min-w-[290px] max-w-8xl mx-auto px-4"">

            <div class="border rounded-lg p-6 bg-[color:var(--color-background)] dark:bg-gray-300/30 grow">
                <div class="bg-[color:var(--color-primary)]/90 rounded-lg p-2 w-fit">
                    <flux:icon.trending-up class="text-[var(--color-primary-hover)]" />
                </div>
                <h1 class="font-bold text-start mt-3 text-2xl">{{ __('home.titleFirstCard') }}</h1>
                <p class="text-start">{{ __('home.subTitleFirstCard') }}</p>
            </div>

            <div class="border rounded-lg p-6 bg-[color:var(--color-background)] dark:bg-gray-300/30 grow">
                <div class="bg-[color:var(--color-primary)]/90 rounded-lg p-2 w-fit">
                    <flux:icon.chart-pie class="text-[var(--color-primary-hover)]" />
                </div>
                <h1 class="font-bold text-start mt-3 text-2xl">{{ __('home.titleSecondCard') }}</h1>
                <p class="text-start">{{ __('home.subTitleSecondCard') }}</p>
            </div>

            <div class="border rounded-lg p-6 bg-[color:var(--color-background)] dark:bg-gray-300/30 grow">
                <div class="bg-[color:var(--color-primary)]/90 rounded-lg p-2 w-fit">
                    <flux:icon.shield class="text-[var(--color-primary-hover)]" />
                </div>
                <h1 class="font-bold text-start mt-3 text-2xl">{{ __('home.titleThirdCard') }}</h1>
                <p class="text-start">{{ __('home.subTitleThirdCard') }}</p>
            </div>

            <div class="border rounded-lg p-6 bg-[color:var(--color-background)] dark:bg-gray-300/30 grow">
                <div class="bg-[color:var(--color-primary)]/90 rounded-lg p-2 w-fit">
                    <flux:icon.smartphone class="text-[var(--color-primary-hover)]" />
                </div>
                <h1 class="font-bold text-start mt-3 text-2xl">{{ __('home.titleFourthCard') }}</h1>
                <p class="text-start">{{ __('home.subTitleFourthCard') }}</p>
            </div>

            <div class="border rounded-lg p-6 bg-[color:var(--color-background)] dark:bg-gray-300/30 grow">
                <div class="bg-[color:var(--color-primary)]/90 rounded-lg p-2 w-fit">
                    <flux:icon.bolt class="text-[var(--color-primary-hover)]" />
                </div>
                <h1 class="font-bold text-start mt-3 text-2xl">{{ __('home.titleFifthCard') }}</h1>
                <p class="text-start">{{ __('home.subTitleFifthCard') }}</p>
            </div>

            <div class="border rounded-lg p-6 bg-[color:var(--color-background)] dark:bg-gray-300/30 grow">
                <div class="bg-[color:var(--color-primary)]/90 rounded-lg p-2 w-fit">
                    <flux:icon.wallet class="text-[var(--color-primary-hover)]" />
                </div>
                <h1 class="font-bold text-start mt-3 text-2xl">{{ __('home.titleSixthCard') }}</h1>
                <p class="text-start">{{ __('home.subTitleSixthCard') }}</p>
            </div>

        </div>
    </section>

    {{-- Info --}}
    <section class="py-12">
        <div class="flex flex-col items-center gap-12 lg:flex-row lg:justify-center lg:gap-48 ">
            <div>
                <p class="text-[color:var(--color-primary)] text-center font-bold text-5xl">10k+</p>
                <p class="text-gray-400 text-xl">{{ __('home.activeUsers') }}</p>
            </div>
            <div>
                <p class="text-[color:var(--color-primary)] text-center font-bold text-5xl">$2M+</p>
                <p class="text-gray-400 text-xl">{{ __('home.manageMoney') }}</p>
            </div>
            <div>
                <p
                    class="text-[color:var(--color-primary)] flex items-center justify-center text-center font-bold text-5xl">
                    4.9<flux:icon.star class="size-10"></flux:icon.star>
                </p>
                <p class="text-gray-400 text-xl">{{ __('home.appValoration') }}</p>
            </div>
        </div>
    </section>

    {{-- Register --}}
    <section class="bg-[color:var(--color-primary-opacity)] ">
        <div class="py-24 flex justify-center flex-col items-center">
            <h1 class="text-2xl md:text-4xl text-center mt-2">{{ __('home.finalTextHeader') }}</h1>
            <p class="text-gray-400 text-center mx-8 dar:text-gray-600 mt-2 text-md md:text-xl">
                {{ __('home.finalTextPar') }}</p>
            <a href="{{ route('register') }}">
                <flux:button variant="primary" color="green" class="bg-[color:var(--color-primary)] text-xl mt-5">
                    {{ __('home.finalTextButton') }}</flux:button>
            </a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="flex justify-center text-center">
        <div class="flex flex-col gap-3 justify-center mt-10 mb-5">
            <div class="flex items-center text-center mx-auto w-fit gap-1"><x-app-logo /></div>
            <div>{{ __('home.footer', ['year' => \Carbon\Carbon::now()->year]) }}</div>
        </div>
    </footer>
</x-layouts.welcome>
