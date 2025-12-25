@extends('layout.app')

@section('title', 'Contents Editor')

@section('content')
    <div class="bg-neutral-950/30 backdrop-blur-2xl sticky top-16 pb-2 pt-6 mb-6">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-neutral-200">
                    Contents List
                </h2>
                <p class="text-sm text-neutral-500">
                    Contents List
                </p>
            </div>

            <a href="{{ route('contents.create') }}" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M19.5 21a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3h-5.379a.75.75 0 0 1-.53-.22L11.47 3.66A2.25 2.25 0 0 0 9.879 3H4.5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h15Zm-6.75-10.5a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V10.5Z"
                        clip-rule="evenodd" />
                </svg>
                Add New Contents
            </a>
        </div>
    </div>
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        @include('contents.table')
    </div>
@endsection
