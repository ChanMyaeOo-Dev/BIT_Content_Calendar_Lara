<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div id="toast-container" class="fixed bottom-5 right-5 z-[999] space-y-3">
</div>

<body class="bg-zinc-950 text-zinc-200">
    <!-- Header -->
    <header class="bg-zinc-900 border-b border-zinc-800 fixed w-full z-50">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <a href="{{ route('/') }}">
                <div class="flex items-center gap-2">
                    <div class=" bg-rose-500 text-white p-1 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                    </div>
                    <h1 class="text-lg font-bold font-sans">
                        BIT Content <span class="text-rose-500">Calendar</span>
                    </h1>
                </div>
            </a>
            <div class="flex items-center justify-end gap-2">
                @include('layout.nav')
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="py-28">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const formId = this.dataset.form;
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48', // rose-600
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(formId).submit();
                    }
                });
            });
        });

    });
    </script>

    <script>
        window.showToast = function (
        message,
        type = 'success',
        duration = 3000
    ) {
        const colors = {
            success: 'bg-emerald-600',
            error: 'bg-rose-500',
            warning: 'bg-amber-500',
            info: 'bg-sky-500'
        };

        const toast = document.createElement('div');
        toast.className = `
            flex items-center gap-3 px-4 py-3 text-white rounded-md shadow-lg
            animate-slide-in ${colors[type] ?? colors.success}
        `;
        toast.innerHTML = `
            <span class="text-sm font-medium">${message}</span>
            <button class="ml-auto text-white/80 hover:text-white">
                ✕
            </button>
        `;

        document.getElementById('toast-container').appendChild(toast);

        const removeToast = () => {
            toast.classList.add('opacity-0', 'translate-x-5');
            setTimeout(() => toast.remove(), 300);
        };

        toast.querySelector('button').onclick = removeToast;
        setTimeout(removeToast, duration);
    };
    </script>

    @if(session('toast'))
    <script>
        showToast(
        "{{ session('toast.message') }}",
        "{{ session('toast.type') }}"
    );
    </script>
    @endif


</body>

</html>