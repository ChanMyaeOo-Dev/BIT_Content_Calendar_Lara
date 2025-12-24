@extends('layout.app')

@section('title', 'Contents Editor')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <input type="text" form="data_form" name="title"
            class="text-2xl font-semibold text-neutral-200 border-none focus:outline-none" value="Untitled Content">
        <p class="text-sm text-neutral-500">
            Create New Contents
        </p>
    </div>

    <div class="flex items-center gap-2">
        <a href="{{ route('contents.index') }}" class="btn-outline-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                <path fill-rule="evenodd"
                    d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z"
                    clip-rule="evenodd" />
            </svg>
            Back
        </a>
        <button type="submit" form="data_form" class="btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                <path fill-rule="evenodd"
                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                    clip-rule="evenodd" />
            </svg>
            Done
        </button>
    </div>
</div>

@include('contents.form')
<script>
    document.addEventListener('DOMContentLoaded', async () => {
    try {
        const text = await navigator.clipboard.readText();
        document.getElementById('json_data').value = text;
    } catch (e) {
        console.warn('Clipboard access blocked by browser');
    }
});
</script>
@endsection