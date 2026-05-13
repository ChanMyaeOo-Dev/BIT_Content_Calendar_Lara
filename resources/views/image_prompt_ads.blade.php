@extends('layout.app')

@section('content')
    <div class="bg-neutral-950/30 backdrop-blur-2xl sticky top-16 pb-2 pt-6 mb-6">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class=" grid grid-cols-1 md:grid-cols-2 gap-3">

                <div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col mb-3">
                    <div
                        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
                        <p class="text-nowrap">Headline</p>
                    </div>
                    <input type="text" id="headline" value="Professional Web Development Course" class="text-neutral-300 m-8 leading-9 focus:outline-none" autofocus>
                </div>

                <div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col mb-3">
                    <div
                        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
                        <p class="text-nowrap">Color</p>
                    </div>
                    <input type="text" id="color" value="blue"
                        class="text-neutral-300 m-8 leading-9 focus:outline-none">
                </div>

                <div class="bg-neutral-900 rounded-lg border border-neutral-800 hidden flex-col mb-3">
                    <div
                        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
                        <p class="text-nowrap">Sub Title</p>
                    </div>
                    <input type="text" id="sub_title" value="Job Ready Developer Class" class="text-neutral-300 m-8 leading-9 focus:outline-none">
                </div>

                <div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col mb-3">
                    <div
                        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
                        <p class="text-nowrap">Course Price</p>
                    </div>
                    <input type="text" id="course_price" value="300,000 Kyats" class="text-neutral-300 m-8 leading-9 focus:outline-none">
                </div>

                <div class="bg-neutral-900 rounded-lg border border-neutral-800 flex flex-col mb-3">
                    <div
                        class="flex items-center justify-between bg-neutral-900 border-b border-b-neutral-800 border-t border-t-rose-500 rounded-t-md px-8 py-3">
                        <p class="text-nowrap">Tech Stack</p>
                    </div>
                    <input type="text" id="tech_stack" value="HTML, CSS, Javascript, PHP, Laravel, MySql" class="text-neutral-300 m-8 leading-9 focus:outline-none">
                </div>

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
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", async () => {

            const btn = document.querySelector(".btn_copy");
            btn.addEventListener("click", async () => {
                const headline = document.getElementById('headline').value;
                const sub_title = document.getElementById('sub_title').value;
                const color = document.getElementById('color').value;
                const course_price = document.getElementById('course_price').value;
                const tech_stack = document.getElementById('tech_stack').value;
                const copy_template = getFullText(headline, sub_title, color, course_price,tech_stack);
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
        function getFullText(headline, sub_title, color, course_price, tech_stack) {
            return `
Create a premium, modern social media marketing graphic in a 1:1 square aspect ratio, designed in a high-end SaaS/fintech visual style.

INPUT CONTENT:
Main Title: “${headline}”
Course Price: “${course_price}”
Tech Stack: “${tech_stack}”
Brand Name: “Digital Corner”
Logo: No Logo
---

CORE OBJECTIVE:
Design a high-conversion course promotion visual that feels clean, spacious, modern, and premium — like it was crafted by a senior graphic designer. Prioritize clarity, hierarchy, and spacing over decoration.

---

SPACING SYSTEM (STRICT):
Use generous outer margins (safe area).
Maintain consistent spacing between elements.
Do not stack elements tightly.
Each element must have breathing room.
Group related items, separate sections clearly.
Empty space is intentional.
If crowded, remove elements instead of reducing spacing.

---

Background:
Use a deep gradient base (deep dark → dark ${color} → near-black).
Add a soft radial glow or spotlight at the center for depth.
Include a very subtle grid, noise, or abstract tech pattern (low opacity) to enhance dimension without distraction.
Lighting should feel soft, cinematic, and slightly futuristic.

Layout & Composition:
Use a clean grid-based layout (prefer left-aligned or slightly asymmetric).
Avoid cramped or overly centered layouts.
Divide into zones:
Balanced, centered composition with clear visual hierarchy.
Use generous padding and whitespace for a premium feel.
Include a rounded rectangle frame or faint glowing border lines to contain the design.
Incorporate subtle glassmorphism or UI card elements (blurred panels, soft transparency).

* Text zone
* Visual zone
* Supporting info zone

Visual flow:
Main Title → Visual → Tech Stack → Price (No need price icon) → Branding

---

AI VISUAL DECISION SYSTEM:
Choose ONE approach based on title meaning:

Option A — Character-Based
Option B — Object/Product-Based
Option C — Abstract/Conceptual

Rules:
Use only ONE approach.
Do not mix styles.
Keep visuals simple and supportive.

---

MAIN TITLE TYPOGRAPHY SYSTEM (VERY IMPORTANT):

The AI must intelligently design the headline like a senior graphic designer.

Rules:

* Do NOT treat the title as one uniform text block
* Break the title into two logical phrases
* Identify key words (most important meaning) and secondary words

Hierarchy Control:

1. Primary Keywords:

* Largest size
* Highest contrast
* Strongest visual emphasis

2. Secondary Words:

* Smaller size
* Lower visual weight
* Support the primary words

3. Optional Structure:

* Multi-line layout is preferred
* Use line breaks intentionally for balance
* Avoid long single-line headlines

Styling Techniques (use subtly):

* Size variation (large vs medium)
* Weight contrast (bold vs regular)
* Slight color emphasis (${color} accent only on key words)
* Spacing between lines for readability

Strict Rules:

* Maintain clean alignment
* Do not over-style every word
* Keep it minimal and premium
* Ensure readability at a glance

Goal:
The headline must feel designed, not typed.

---

TECH STACK DESIGN SYSTEM:

Present the tech stack in one clean style (choose ONE):

* Logo row (small, evenly spaced icons)
* Text pills/tags
* Logo + text combo
* Minimal inline text list

Rules:

* Maintain spacing
* Do not dominate layout
* Avoid colorful clutter

---

VISUAL BALANCE RULE:
Main Title is the focal point
Visual supports, not dominates
Tech stack is secondary
Maintain strong negative space

---

BACKGROUND:
Deep gradient (deep dark → near-black)
Soft ${color} glow
Subtle radial lighting
Optional very light texture
Keep minimal

---

TEXT HIERARCHY:

Main Title:
Designed with hierarchy (not uniform)

Course Price:
Highlighted (badge/pill), separated clearly

Brand Name + Logo:
Minimal, placed in quiet area

---

DESIGN ELEMENTS:
Minimal glassmorphism if needed
Subtle UI elements only when helpful
Soft shadows and glow accents

Avoid clutter and unnecessary elements

---

CHARACTER STYLE (if used):
Single character
Professional semi-realistic 3D
Natural pose
Soft cinematic lighting

---

OBJECT STYLE (if used):
Clean 3D render
Minimal environment
Premium lighting

---

COLOR SYSTEM:
Primary: deep dark / near-black
Accent: soft ${color}
Text: white
No extra strong colors

---

QUALITY CONTROL (MANDATORY):
No clutter
No tight spacing
No multiple focal points
Elements must not touch
Strong negative space required
Design must feel calm, balanced, and premium

---

FINAL OUTPUT:
A clean, spacious, high-end SaaS-style course advertisement with excellent typography hierarchy, strong composition, and professional spacing.

---

FINAL INSTRUCTION:
No need to add Subtitle.
Design with restraint.
Prioritize spacing, hierarchy, and clarity.
The headline must be visually structured with clear emphasis — like a professionally designed typographic layout, not a plain text block.`;
        }
    </script>
@endsection
