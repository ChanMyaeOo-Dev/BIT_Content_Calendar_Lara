<div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col mb-4">
    <div
        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
        <p class="text-nowrap">Content Body</p>
    </div>
    <textarea form="data_form" name="body" id="body" class="text-neutral-300 m-8 leading-9 focus:outline-none" rows="10"
        autofocus>{{ isset($post) ? $post->body : old('body') }}</textarea>
    @error('body')
    <div class="text-rose-500 text-sm mx-8 my-3">
        {{ "!!! ".$message }}
    </div>
    @enderror
</div>
<div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col">
    <div
        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
        <p class="text-nowrap">Slide Json Data</p>
    </div>
    <textarea form="data_form" name="slide_json_data" id="slide_json_data"
        class="text-neutral-300 m-8 leading-9 focus:outline-none" rows="6"
        autofocus>{!! isset($post) ? json_encode($post->slide_json_data,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : old('slide_json_data') !!}</textarea>
    @error('slide_json_data')
    <div class="text-rose-500 text-sm mx-8 my-3">
        {{ "!!! ".$message }}
    </div>
    @enderror
</div>