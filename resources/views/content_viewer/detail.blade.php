@extends('layout.app')

@section('title', 'Content Detail Viewer')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-semibold text-neutral-200 border-none focus:outline-none">Content Detail Viewer</h2>
        <p class="text-sm text-neutral-500">
            Content Detail Viewer
        </p>
    </div>

    <div class="flex items-center gap-2">
        <a href="{{ route('viewer.index') }}" class="btn-outline-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                <path fill-rule="evenodd"
                    d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z"
                    clip-rule="evenodd" />
            </svg>
            Back
        </a>
        <button type="submit" form="data_form" class="btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
            </svg>
            Save
        </button>
    </div>
</div>

@if (count($result) > 0)

<form id="data_form" action="{{ route('viewer.detail') }}" method="POST">
    @csrf
    <div class="bg-neutral-900 rounded-lg border border-neutral-800 pb-8 flex flex-col mb-6">
        <div
            class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-4 mb-3">
            <span class=" text-nowrap">Dialogue Script</span>
            <button type="button"
                class="copy-btn flex items-center justify-center gap-1 text-xs hover:shadow-lg duration-200 hover:text-rose-500 group-hover:text-rose-500 bg-neutral-950 hover:bg-neutral-950 border border-neutral-800 rounded-md py-3 px-6"
                data-target="dialog_script">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                </svg>
                Copy
            </button>
        </div>
        <div class="px-8">
            <textarea form="data_form" name="dialog_script" id="dialog_script"
                class="w-full text-neutral-300 leading-9 focus:outline-none"
                rows="20">{{ $result && $result[0] }}</textarea>
        </div>
    </div>
    @php
    $rawText = $result[1];
    if (preg_match('/\{(?:[^{}]|(?R))*\}/s', $rawText, $matches)) {
    $jsonString = $matches[0];
    $data = json_decode($jsonString, true);
    $presentation_meta = $data['presentation_meta'];
    $slides = $data['slides'];
    $images = [];
    foreach($slides as $slide) {
    foreach($slide['visual_asset_suggestion'] as $img_txt) {
    $images[] = $img_txt;
    $jsonImages = json_encode($images, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    }
    } else {
    print_r("JSON not found in the text.");
    }
    @endphp

    <div class="bg-neutral-900 rounded-lg border border-neutral-800 pb-8 flex flex-col mb-6">
        <div
            class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-4 mb-3">
            <span class=" text-nowrap">Images Prompts</span>
            <button type="button"
                class="copy-btn flex items-center justify-center gap-1 text-xs hover:shadow-lg duration-200 hover:text-rose-500 group-hover:text-rose-500 bg-neutral-950 hover:bg-neutral-950 border border-neutral-800 rounded-md py-3 px-6"
                data-target="slide_json">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                </svg>
                Copy
            </button>
        </div>
        <div class="px-8">
            <textarea form="data_form" name="slide_json" id="slide_json"
                class="w-full text-neutral-300 leading-9 focus:outline-none"
                rows="7">{{ config('constants.images_prompt_prefix') . $jsonImages  }}</textarea>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 bg-neutral-900 border border-neutral-800 p-6 rounded-md">
        @foreach ($slides as $slide)
        <div class="bg-neutral-900 rounded-lg border border-neutral-800 pb-8 flex flex-col">
            <div
                class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-4 mb-3">
                <p class="text-nowrap">{{ $slide['slide_number'].'. '.$slide['title'] }}</p>
            </div>
            <div class="px-8 flex flex-col gap-3">
                @foreach ($slide['content_points'] as $content_point)
                <p class="text-nowrap">{{ $content_point }}</p>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</form>

@else

<div class="card">
    <div class="flex flex-col gap-2 items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-8 text-rose-700">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <p class="text-nowrap underline italic text-neutral-400">Broken Format</p>
    </div>
</div>

@endif

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const copyButtons = document.querySelectorAll(".copy-btn");

    copyButtons.forEach(button => {
        button.addEventListener("click", function() {
            const targetId = this.dataset.target;
            const textarea = document.getElementById(targetId);

            if (textarea) {
                textarea.select();
                textarea.setSelectionRange(0, 99999);

                try {
                    document.execCommand('copy');
                    showToast("Copied to clipboard!",'success');
                } catch (err) {
                    showToast("Failed to copy!",'error');
                }
                window.getSelection().removeAllRanges();
            }
        });
    });
});
</script>