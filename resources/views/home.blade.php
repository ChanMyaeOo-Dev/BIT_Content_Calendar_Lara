@extends('layout.app')

@section('title', 'Home')

@section('content')
    <div class="bg-neutral-950/30 backdrop-blur-2xl sticky top-16 pb-2 pt-6 mb-6">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            @if ($content && isset($content->json_data['contents']))
                @foreach ($content->json_data['contents'] as $index => $item)
                    @include('components.ContentCard')
                @endforeach
            @else
                <p>ပြသစရာ အချက်အလက် မရှိသေးပါ။</p>
            @endif
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
                        btn.innerText = "Copied ✔";
                        setTimeout(() => {
                            btn.innerText = "Copy";
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
                    "voice_signature": "Direct, Concise, Sincere. (စကားကို ဝေ့ဝိုက်မနေဘဲ လိုရင်းကို ထိထိမိမိ ပြောသည်။)",
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
                    "5_dialogue_script_raw_text": "** In a copyable format with code frame ** formated_for_easy_reading_and_line_spaces_loosely(2_introduction + 3_dialogue_script. + 4_hashtags)",
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
                                    "Detail and well structured image grnaration prompt to generate realistic real images with ai. Consistency in image generation."
                                ]
                            }]
                        }
                    }
                }
            })
        }
    </script>
@endsection
