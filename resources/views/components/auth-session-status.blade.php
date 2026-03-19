@props([
    'status=>null', 'error=>null'
])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@endif

@if ($error)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-red-600']) }}>
        {{ $error }}
    </div>
@endif