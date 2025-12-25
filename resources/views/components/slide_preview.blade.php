@php
    $slide_json_datas = $post->slide_json_data;
    $presentation_meta = $slide_json_datas['presentation_meta'];
    $slides = $slide_json_datas['slides'];
    $images = [];
    foreach ($slides as $slide) {
        foreach ($slide['visual_asset_suggestion'] as $img_txt) {
            $images[] = $img_txt;
            $jsonImages = json_encode($images, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }
@endphp

<div id="image_prompt_box" class="bg-neutral-900 rounded-lg border border-neutral-800 pb-8 flex flex-col mb-6">
    <div
        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-4 mb-3">
        <span class=" text-nowrap">Images Prompts</span>
    </div>
    <div class="px-8">
        <textarea readonly form="data_form" name="slide_json" id="slide_json"
            class="w-full text-neutral-300 leading-9 focus:outline-none" rows="7">{{ config('constants.images_prompt_prefix') . $jsonImages }}</textarea>
    </div>
</div>

<div id="slide_visual_box"
    class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 bg-neutral-900 border border-neutral-800 p-6 rounded-md">
    @foreach ($slides as $slide)
        <div class="bg-neutral-900 rounded-lg border border-neutral-800 pb-8 flex flex-col">
            <div
                class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-4 mb-3">
                <p class="text-nowrap">{{ $slide['slide_number'] . '. ' . $slide['title'] }}</p>
            </div>
            <div class="px-8 flex flex-col gap-3">
                @foreach ($slide['content_points'] as $content_point)
                    <p class="text-nowrap">{{ $content_point }}</p>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
