@extends('layout.app')

@section('title', 'Notes Editor')

@section('content')
    <div class="bg-neutral-950/30 backdrop-blur-2xl sticky top-16 pb-2 pt-6 mb-6">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-neutral-200">
                    Notes List
                </h2>
                <p class="text-sm text-neutral-500">
                    Notes List
                </p>
            </div>

            <a href="{{ route('notes.create') }}" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M8.25 3A3.75 3.75 0 0 0 4.5 6.75v10.5A3.75 3.75 0 0 0 8.25 21h7.5A3.75 3.75 0 0 0 19.5 17.25V6.75A3.75 3.75 0 0 0 15.75 3h-7.5Zm4.28 5.47a.75.75 0 0 0-1.06-1.06l-3.5 3.5a.75.75 0 0 0 0 1.06l3.5 3.5a.75.75 0 1 0 1.06-1.06l-2.22-2.22H14.5a.75.75 0 0 0 0-1.5h-4.19l2.22-2.22Z"
                        clip-rule="evenodd" />
                </svg>
                Add New Note
            </a>
        </div>
    </div>

    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        @include('notes.table')
        {{ $notes->links() }}
    </div>
@endsection

