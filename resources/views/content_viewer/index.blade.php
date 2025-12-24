@extends('layout.app')

@section('title', 'Contents Editor')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-semibold text-neutral-200 border-none focus:outline-none">Content Viewer</h2>
        <p class="text-sm text-neutral-500">
            Paste the raw text here
        </p>
    </div>

    <div class="flex items-center gap-2">
        <button type="submit" form="data_form" class="btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3" />
            </svg>
            Next Step
        </button>
    </div>
</div>

<div class="bg-neutral-900 rounded-lg border border-neutral-800 p-8 flex flex-col">
    <form id="data_form" action="{{ route('viewer.detail') }}" method="GET">
        <textarea form="data_form" name="raw_text" id="raw_text"
            class="w-full text-neutral-300 leading-9 focus:outline-none" rows="14" autofocus></textarea>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
    try {
        const text = await navigator.clipboard.readText();
        document.getElementById('raw_text').value = text;
    } catch (e) {
        console.warn('Clipboard access blocked by browser');
    }
});
</script>
@endsection