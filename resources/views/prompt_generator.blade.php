@extends('layout.app')

@section('title', 'Ko Chen | Digital Corner')

@section('content')
    <div class="bg-neutral-950/30 backdrop-blur-2xl sticky top-16 pb-2 pt-6 mb-6">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col">
                <div
                    class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
                    <p class="text-nowrap">Question</p>
                </div>
                <textarea id="question" class="text-neutral-300 m-8 leading-9 focus:outline-none" rows="10" autofocus></textarea>
            </div>
            <div class="flex items-center justify-center gap-2">
                <button type="button" class="btn_copy cursor-pointer mt-3 !bg-neutral-900">
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
                </button>

                <a href="https://gemini.google.com/app" class="btn_copy cursor-pointer mt-3 !bg-neutral-900"
                    target="_blank">
                    <div class="flex items-center justify-center gap-1">
                        <span class="text-nowrap">
                            Generate Content
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            try {
                const text = await navigator.clipboard.readText();
                document.getElementById('question').value = cleanText(text);
            } catch (e) {
                console.warn('Clipboard access blocked by browser');
            }

            function cleanText(text) {
                return text
                    .trim();
            }

            const btn = document.querySelector(".btn_copy");
            btn.addEventListener("click", async () => {
                const copy_template = getFullText(document.getElementById('question').value);
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
                    console.log(err)
                    alert("Copy failed");
                }
            });
        });
    </script>

    <script>
        function getFullText(title) {
            return "အောက်က json structure ထဲက အချက်အလက်တွေအတိုင်း Content တစ်ပုဒ် ဖန်တီးပေးပါ။ " + '\n\n' + JSON
                .stringify({
                    "Role": "Content Rewriter + Personalization Engine",

                    "task": "Below content ကို ဖတ်ပြီး meaning မပြောင်းဘဲ rewrite ပြန်ရေးပါ။ Direct translate မလုပ်ရ။ Natural Facebook post style ပြောင်းပါ။",

                    "input_content": title,

                    "output_goal": "Make it sound like I read this and I am sharing it in my own words.",

                    "style_guardrails": {

                        "core_rules": [
                            "Meaning MUST stay the same.",
                            "Do NOT add new technical ideas.",
                            "Do NOT remove key insights.",
                            "Rewrite only."
                        ],

                        "pov_rule": [
                            "Use first-person (ကျွန်တော် / ကိုယ်).",
                            "Make it feel like I am sharing something I just learned."
                        ],

                        "facebook_style": [
                            "Start with a natural hook (something I noticed / learned).",
                            "No formal intro.",
                            "No definition-style opening.",
                            "Flow like a personal post."
                        ],

                        "language_rules": {
                            "grammar_enforcement": "STRICTLY SPOKEN BURMESE ONLY",
                            "flow_control": "Short sentences. Natural pauses. Like talking."
                        },

                        "transformation_rules": [
                            "Compress unnecessary words.",
                            "Make sentences clearer and simpler.",
                            "Replace formal tone with conversational tone.",
                            "If original is complex, simplify but keep meaning."
                        ],

                        "forbidden": [
                            "Textbook explanation tone",
                            "Bullet point teaching style",
                            "Direct translation style",
                            "Robotic wording"
                        ],

                        "ending_rule": "End like a personal takeaway or reflection."
                    }
                })
        }
    </script>
@endsection
