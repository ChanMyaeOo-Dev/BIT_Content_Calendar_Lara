<div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col mb-4">
    <div
        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
        <p class="text-nowrap">Note Body (Markdown)</p>
    </div>

    <textarea form="data_form" name="body" id="body"
        class="body text-neutral-300 m-8 leading-9 focus:outline-none caret-rose-500 focus:caret-rose-600 cursor-text"
        rows="10" autofocus>{{ isset($note) ? $note->body : old('body') }}</textarea>

    @error('body')
        <div class="text-rose-500 text-sm mx-8 my-3">
            {{ '!!! ' . $message }}
        </div>
    @enderror
</div>

@php
    $markdownBody = isset($note) ? ($note->body ?? '') : (old('body') ?? '');
@endphp

<div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col">
    <div
        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
        <p class="text-nowrap">Preview</p>
    </div>

    <div class="p-8 text-neutral-300 notes-markdown">
        @if (trim($markdownBody) !== '')
            {!! renderMarkdown($markdownBody) !!}
        @else
            <p class="text-sm text-neutral-500">
                Start writing Markdown to see a preview.
            </p>
        @endif
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const updateBtn = document.getElementById('update_btn');
            if (!updateBtn) return;

            updateBtn.addEventListener('click', async () => {
                const form = document.getElementById('data_form');
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                const formData = new FormData(form);

                updateBtn.disabled = true;
                updateBtn.innerText = 'Updating...';

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
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
                    if (error?.errors) {
                        Object.values(error.errors).forEach(err => {
                            alert(err[0]);
                        });
                    } else {
                        alert('Something went wrong');
                    }
                } finally {
                    updateBtn.disabled = false;
                    updateBtn.innerText = 'Update';
                }
            });
        });
    </script>
@endpush

