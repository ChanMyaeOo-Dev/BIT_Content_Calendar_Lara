<div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col mb-4">
    <div
        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
        <p class="text-nowrap">Content Body</p>

        <div class="flex items-center gap-2">
            <button id="full_screen_btn_update" type="button" form="data_form"
                class="hidden items-center gap-2 px-3 py-2 text-sm font-medium text-white border border-rose-600 bg-rose-500 hover:bg-rose-600 rounded-md duration-300 cursor-pointer hover:-translate-y-1">
                Save
            </button>
            <button id="btn_post_body_zoom" type="button" class="btn_sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                </svg>
            </button>
        </div>
    </div>
    <textarea form="data_form" name="body" id="body" class="text-neutral-300 m-8 leading-9 focus:outline-none"
        rows="10" autofocus>{{ isset($post) ? $post->body : old('body') }}</textarea>
    @error('body')
        <div class="text-rose-500 text-sm mx-8 my-3">
            {{ '!!! ' . $message }}
        </div>
    @enderror
</div>
@if (request()->routeIs('posts.edit') && count($post->slide_json_data) > 0)
    @include('components.slide_preview')
@endif

<div id="slide_json_data_box" class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col">
    <div
        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
        <p class="text-nowrap">Slide Json Data</p>
    </div>
    <textarea form="data_form" name="slide_json_data" id="slide_json_data"
        class="text-neutral-300 m-8 leading-9 focus:outline-none" rows="6" autofocus>{!! isset($post)
            ? json_encode($post->slide_json_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            : old('slide_json_data') !!}</textarea>
    @error('slide_json_data')
        <div class="text-rose-500 text-sm mx-8 my-3">
            {{ '!!! ' . $message }}
        </div>
    @enderror
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const full_screen_btn_update = document.getElementById('full_screen_btn_update');

        document.getElementById('btn_post_body_zoom').addEventListener('click', () => {
            zoomTasks();
        });

        function zoomTasks() {
            const header = document.getElementById('header');
            const post_action_bar = document.getElementById('post_action_bar');
            const slide_json_data_box = document.getElementById('slide_json_data_box');
            const image_prompt_box = document.getElementById('image_prompt_box');
            const slide_visual_box = document.getElementById('slide_visual_box');
            const post_container = document.getElementById('post_container');
            const main_container = document.getElementById('main_container');
            const text_area_body = document.getElementById('body');
            full_screen_btn_update.classList.toggle('flex');
            full_screen_btn_update.classList.toggle('hidden');
            header.classList.toggle('hidden');
            post_action_bar.classList.toggle('hidden');
            slide_json_data_box.classList.toggle('hidden');
            image_prompt_box?.classList.toggle('hidden');
            slide_visual_box?.classList.toggle('hidden');
            post_container.classList.toggle('max-w-6xl');
            post_container.classList.toggle('w-full');
            main_container.classList.toggle('mt-16');
            main_container.classList.toggle('mt-8');
            text_area_body.rows = text_area_body.rows == 10 ? 18 : 10;
            btn_post_body_zoom.innerHTML = text_area_body.rows == 10 ?
                `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="size-4">
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
</svg>` :
                `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="size-4">
    <path stroke-linecap="round" stroke-linejoin="round"
        d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
</svg>`;
        }

    });
</script>

@push('script')
    <script>
        document.addEventListener('keydown', function(e) {
            const isCtrlOrCmd = e.ctrlKey || e.metaKey;

            if (isCtrlOrCmd && e.key.toLowerCase() === 's') {
                e.preventDefault();
                // alert('CTRL + S detected');
                document.getElementById('full_screen_btn_update')?.click();
            }
        });
        document.getElementById('update_btn').addEventListener('click', () => {
            document.getElementById('full_screen_btn_update')?.click();
        })
        full_screen_btn_update.addEventListener('click', async () => {
            const form = document.getElementById('data_form');
            const button = document.getElementById('full_screen_btn_update');

            const formData = new FormData(form);

            button.disabled = true;
            button.innerText = 'Updating...';

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }
                if (data.toast) {
                    showToast(data.toast.message, data.toast.type);
                }
            } catch (error) {
                console.error(error);
                if (error.errors) {
                    Object.values(error.errors).forEach(err => {
                        alert(err[0]);
                    });
                } else {
                    alert('Something went wrong');
                }
            } finally {
                button.disabled = false;
                button.innerText = 'Save';
            }
        });
    </script>
@endpush
