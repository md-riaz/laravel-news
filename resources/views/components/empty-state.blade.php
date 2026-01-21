@props(['message'])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500']) }}>
    {{ $message }}
</div>
