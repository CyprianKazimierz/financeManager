@props(['title', 'titleTwo', 'description'])

<div class="flex w-full flex-col gap-2 text-center">
    <h1 class="text-2xl font-bold dark:text-zinc-200">{{ $title }}
        <span
            class="bg-linear-to-r from-[var(--color-primary)] to-emerald-300 dark:to-skye-200 bg-clip-text text-transparent">
            {{ $titleTwo }}
        </span>
    </h1>
    <p class="text-center text-md mb-1 dark:text-gray-400">{{ $description }}</p>
</div>
