<div class="bg-neutral-900 rounded-lg border border-neutral-800 p-8 flex flex-col">
    <form id="data_form" action="{{ route('contents.store') }}" method="POST">
        @csrf
        <textarea form="data_form" name="json_data" id="json_data"
            class="w-full text-neutral-300 leading-9 focus:outline-none" rows="20" autofocus></textarea>
        @error('json_data')
        <div class="text-rose-500 text-sm my-3">
            {{ "!!! ".$message }}
        </div>
        @enderror
    </form>
</div>