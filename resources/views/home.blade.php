@extends('layout.app')

@section('title', 'BIT Content Calendar')

@section('content')
    <div class="bg-neutral-950/30 backdrop-blur-2xl sticky top-16 pb-2 pt-6 mb-6">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            @include('components.QuickLinks')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if ($content && isset($content->json_data['contents']))
                    @foreach ($content->json_data['contents'] as $index => $item)
                        @include('components.ContentCard')
                    @endforeach
                @else
                    <p>ပြသစရာ အချက်အလက် မရှိသေးပါ။</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const items = @json($content->json_data['contents']);
            document.querySelectorAll(".btn_copy").forEach(btn => {
                btn.addEventListener("click", async () => {
                    const targetId = btn.dataset.target;
                    const copy_template = getFullText(items[targetId].title, items[targetId]
                        .content_format, items[targetId].core_concept);
                    try {
                        await navigator.clipboard.writeText(copy_template);
                        btn.innerHTML = `
                            <div class="flex items-center justify-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class="text-nowrap">
                                    Copied
                                </span>
                            </div>
                            `;
                        setTimeout(() => {
                            btn.innerHTML = `
                            <div class="flex items-center justify-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                </svg>
                                <span class="text-nowrap">
                                    Copy
                                </span>
                            </div>
                            `;
                        }, 1500);
                    } catch (err) {
                        alert("Copy failed");
                    }
                });
            });
        });
    </script>

    <script>
        function getFullText(title, content_format, core_concept) {
            return "အောက်က json structure ထဲက အချက်အလက်တွေအတိုင်း Content တစ်ပုဒ် ဖန်တီးပေးပါ။ " + '\n\n' + JSON.stringify({
                "task": "Content တစ်ပုဒ် ဖန်တီးပေးပါ။",
                "title": title,
                "content_format": content_format,
                "core_concept": core_concept,
                "target_audience": "Beginners/Junior Developers",
                "style_guardrails": {
                    "persona": "Experienced Mentor/Teacher (ရင့်ကျက်တည်ငြိမ်သော ဆရာ).",
                    "voice_signature": "Direct, Concise, Sincere. (စကားကို ဝေ့ဝိုက်မနေဘဲ လိုရင်းကို ထိထိမိမိ ပြောပါ။)",
                    "language_rules": {
                        "self_reference": "Use 'ကျွန်တော်' (STRICT)",
                        "audience_reference": "Use 'ညီတို့ညီမတို့' (STRICT)",
                        "grammar_enforcement": "STRICTLY SPOKEN BURMESE ONLY. (စာရေးဟန် လုံးဝ မသုံးရ).",
                        "syntax_replacements": {
                            "MUST_NOT_USE": [
                                "ဟာ",
                                "မိမိ",
                                "သည်",
                                "သည့်",
                                "မည်",
                                "မည့်",
                                "၏",
                                "၌",
                                "၍",
                                "သော",
                                "၎င်း"
                            ],
                            "MUST_USE_INSTEAD": [
                                "က",
                                "ကိုယ်",
                                "ကို",
                                "မယ်/ပါမယ်",
                                "ရဲ့",
                                "မှာ",
                                "ပြီးတော့",
                                "တဲ့",
                                "ဒီအရာ"
                            ]
                        },
                        "flow_control": "Use short sentences. Create natural pauses. Speak as if talking face-to-face, not reading a script."
                    },
                    "forbidden_words": [
                        "သင်",
                        "မင်း",
                        "ခင်ဗျား",
                        "နော်",
                        "လား",
                        "ဟုတ်လား",
                        "ရှင့်",
                        "ကျုပ်",
                        "စိုးရိမ်နေသလား",
                        "ကြောက်နေသလား"
                    ],
                    "tone_calibration": "No Rhetorical Questions. No 'Marketing Fluff'. Just pure value delivery. (မေးခွန်းပြန်မမေးပါနှင့်။ အချက်အလက်ကိုသာ တိုက်ရိုက်ပြောပါ။)"
                },
                "structure_requirements": {
                    "1_catchy_headline": {
                        "instruction": "Educational & High Value. No Clickbait."
                    },
                    "2_introduction": {
                        "instruction": "One or two sentences setting the context. Direct and Serious."
                    },
                    "3_dialogue_script": {
                        "platform": "TikTok/Reels (Educational)",
                        "word_count": "approx 1000 words. 4 paragraphs.",
                        "style": "Natural Spoken Lecture (သဘာဝကျသော စကားပြောဟန်).",
                        "instruction": "Write EXTREMELY NATURAL spoken Burmese. Imagine the user is recording this directly to a camera without reading. Avoid 'Essay Style'.",
                        "structure_flow": {
                            "opening": "Start with a direct statement or fact.",
                            "body": "Explain the concept using 'Spoken Logic'. Use connectors like 'ဒါကြောင့်', 'ဥပမာပြောရရင်', 'တကယ်တော့'.",
                            "closing": "End with a firm encouragement or directive."
                        }
                    },
                    "4_hashtags": "Relevant educational keywords.",
                    "5_dialogue_script_raw_text": "** In a copyable format with code frame not json ** formated_for_easy_reading_and_line_spaces_loosely(2_introduction + 3_dialogue_script. + 4_hashtags)",
                    "6_presentation_slides_data_json": {
                        "instruction": "Inorder to make a presentation for 5_dialogue_script_raw_text, generate RAW JSON data for slides. Data only.",
                        "language_rules": {
                            "grammar_enforcement": "STRICTLY SPOKEN BURMESE ONLY. (စာရေးဟန် လုံးဝ မသုံးရ).",
                            "syntax_replacements": {
                                "MUST_NOT_USE": [
                                    "ဟာ",
                                    "မိမိ",
                                    "သည်",
                                    "သည့်",
                                    "မည်",
                                    "မည့်",
                                    "၏",
                                    "၌",
                                    "၍",
                                    "သော",
                                    "၎င်း"
                                ],
                                "MUST_USE_INSTEAD": [
                                    "က",
                                    "ကိုယ်",
                                    "ကို",
                                    "မယ်/ပါမယ်",
                                    "ရဲ့",
                                    "မှာ",
                                    "ပြီးတော့",
                                    "တဲ့",
                                    "ဒီအရာ"
                                ]
                            }
                        },
                        "required_json_format": {
                            "presentation_meta": {
                                "topic": "string",
                                "title": "string"
                            },
                            "slides": [{
                                "slide_number": "integer",
                                "layout": "string",
                                "title": "string",
                                "subtitle": "string",
                                "content_points": [
                                    "string",
                                    "string"
                                ],
                                "visual_asset_suggestion": [
                                    "string",
                                    "Only 1 detail and well structured image grnaration prompt to generate realistic real images with ai. Consistency in image generation."
                                ]
                            }]
                        }
                    }
                }
            })
        }
    </script>
@endsection
