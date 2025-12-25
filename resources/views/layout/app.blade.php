<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    {{-- app icon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/logo_icon_3d.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logo_icon_3d.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logo_icon_3d.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div id="toast-container" class="fixed bottom-5 right-5 z-[999] space-y-3">
</div>

<body class="bg-neutral-950 text-neutral-200">
    <!-- Header -->
    <header id="header" class="bg-neutral-900 border-b border-neutral-800 fixed top-0 w-full z-50 h-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">
            <a href="{{ route('/') }}">
                <div class="flex items-center gap-2">
                    <div class=" bg-rose-500 text-white p-1 rounded-md">
                        <img src="{{ asset('assets/images/white_logo.png') }}" alt="logo" class="size-5 rounded-md">
                    </div>
                    {{-- <img src="{{ asset('assets/images/logo_icon_3d.png') }}" alt="logo" class="size-10 rounded-md"> --}}
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
    <main id="main_container" class="mt-16">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function(e) {
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
        window.showToast = function(
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

    @if (session('toast'))
        <script>
            showToast(
                "{{ session('toast.message') }}",
                "{{ session('toast.type') }}"
            );
        </script>
    @endif

</body>

</html>
