@extends('layout.app')

@section('content')
    <div class="bg-neutral-950/30 backdrop-blur-2xl sticky top-16 pb-2 pt-6 mb-6">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class=" grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col mb-3">
                    <div
                        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
                        <p class="text-nowrap">Text</p>
                    </div>
                    <input type="text" id="question" class="text-neutral-300 m-8 leading-9 focus:outline-none" autofocus>
                </div>
                <div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col mb-3">
                    <div
                        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
                        <p class="text-nowrap">Color</p>
                    </div>
                    <input type="text" id="color" value="blue"
                        class="text-neutral-300 m-8 leading-9 focus:outline-none">
                </div>
            </div>
            <div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col">
                <div
                    class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
                    <p class="text-nowrap">Character Style</p>
                </div>
                <textarea id="character_style" class="text-neutral-300 m-8 leading-9 focus:outline-none" rows="3" autofocus></textarea>
            </div>
            <div class="flex items-center justify-center gap-2 mb-4">
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

            <div class="p-4 rounded-sm border border-neutral-800">
                <p class="text-neutral-500 italic selection:bg-neutral-500 selection:text-neutral-100">
                    Include two Pixar-style 3D characters: One junior developer (confused/thoughtful expression, neutral
                    posture—not exaggerated) One senior developer (calm, confident, slightly guiding presence) Natural
                    interaction, no speech bubbles, no exaggerated gestures
                </p>
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
                const text = document.getElementById('question').value;
                const character_style = document.getElementById('character_style').value;
                const color = document.getElementById('color').value;
                const copy_template = getFullText(text, character_style, color);
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
        function getFullText(title, character_style, color) {
            const characterSection = character_style && character_style.trim() !== "" ?
                `Include Pixar-style 3D character(s):
${character_style}
Natural interaction, no speech bubbles, no exaggerated gestures` :
                `Character Scene (Auto-Generated):
Do not require a predefined character description.
Instead, intelligently interpret the main headline text (“${title}”) and generate a relevant visual scene.

- The scene should visually represent the meaning, emotion, or context of the headline
- Prefer tech, developer, or digital-work-related scenarios when applicable
- Keep it minimal, professional, and aligned with SaaS branding
- Use subtle, natural character poses (no exaggeration, no speech bubbles)

Examples:
- “Errors” → developer reviewing/debugging code with slight confusion
- “Success” → calm completion moment, confident posture
- “System Design” → planning or discussion scene`;

            return `Create a premium, modern social media graphic in 16:9 aspect ratio, designed in a minimal, high-end SaaS/fintech style.

Art Direction & Style:
Clean, corporate, and polished visual identity inspired by modern startup branding. Emphasize simplicity, strong hierarchy, and a refined tech aesthetic. Avoid clutter completely.

Background:
Use a deep gradient base (navy → dark ${color} → near-black).
Add a soft radial glow or spotlight at the center for depth.
Include a very subtle grid, noise, or abstract tech pattern (low opacity) to enhance dimension without distraction.
Lighting should feel soft, cinematic, and slightly futuristic.

Layout & Composition:
Balanced, centered composition with clear visual hierarchy.
Use generous padding and whitespace for a premium feel.
Include a rounded rectangle frame or faint glowing border lines to contain the design.
Incorporate subtle glassmorphism or UI card elements (blurred panels, soft transparency).

Main Headline:
Text: “${title}”
Large, bold, modern sans-serif font.
High contrast (white or soft light-${color}).
Apply slight emphasis using weight variation or subtle gradient glow.
No additional text except the page name.

Branding (Small):
“Ko Chen | Digital Corner”
Place subtly (top corner or bottom area), minimal and clean.

Character Scene:
${characterSection}

Character Styling:
Smooth, slightly glossy skin (Pixar-quality rendering)
Large, expressive eyes with realistic reflections
Soft, cinematic lighting with gentle shadows
Clean, modern clothing (tech/casual style)

Design Details:
Use soft shadows, glow accents, and layered depth
Incorporate minimal UI-inspired elements (small cards, pills, indicators)
Keep everything subtle and aligned with a premium tech product look

Color System:
Primary: deep ${color} / navy gradients
Accent: soft ${color} glow / white highlights
Optional: very light neon ${color} for emphasis

Rendering Quality:
Ultra-sharp, 4K resolution
High-detail, professional rendering
Crisp edges, smooth gradients, no noise or artifacts

Final Output:
Should look like a high-end tech company marketing visual, suitable for LinkedIn or Instagram, with a clean, futuristic, and premium SaaS aesthetic.`;
        }
    </script>
@endsection
