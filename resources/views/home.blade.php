@extends('layout.app')

@section('title', 'Home')

@section('content')
<div class="bg-neutral-950/30 backdrop-blur-2xl sticky top-16 pb-2 pt-6 mb-6">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        @if($content && isset($content->json_data['contents']))
        @foreach($content->json_data['contents'] as $item)
        <div class="content_card group">
            <div class="flex justify-between items-start">
                <span class="text-sm">{{ $item['date'] }}</span>
                <span
                    class="bg-neutral-800 text-neutral-300 text-xs px-2 py-1 rounded group-hover:bg-neutral-900 group-hover:text-rose-500">
                    {{ $item['content_format'] }}
                </span>
            </div>

            <h3 class=" text-base font-semibold mt-3 line-clamp-2">{{ $item['title'] }}</h3>
            <p class="text-neutral-400 mt-2 text-sm leading-6 line-clamp-2">
                {{ $item['core_concept'] }}
            </p>
            <hr class=" text-neutral-700 my-3" />
            <button class="btn_copy">
                <div class="flex items-center justify-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                    <span class=" text-nowrap">
                        Copy Prompt
                    </span>
                </div>
            </button>
        </div>
        @endforeach
        @else
        <p>ပြသစရာ အချက်အလက် မရှိသေးပါ။</p>
        @endif
    </div>
</div>
@endsection