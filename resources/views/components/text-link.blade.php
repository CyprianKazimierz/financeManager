<a {{ $attributes->merge(['class' => 'underline text-sm underline-offset-2 text-[var(--color-primary)] font-bold duration-300 ease-out']) }}
    wire:navigate>
    {{ $slot }}
</a>
