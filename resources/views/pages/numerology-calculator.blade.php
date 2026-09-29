@extends('layouts.app')

@section('title', 'Numerology Calculator — Tamal Chakraborty')
@section('meta_description', 'Calculate your Mulank (Birth Number), Bhagyank (Life Path Number), and Name Number using traditional Pythagorean & Vedic numerology principles.')

@section('content')

<!-- HERO SECTION -->
<section class="relative bg-[#F7F0E3] text-[#29211F] py-16 sm:py-20 overflow-hidden border-b border-[#D8C6A8] flex items-center min-h-[340px]">
    <!-- Celestial & Numerical Overlay -->
    <div class="absolute inset-0 opacity-15 pointer-events-none bg-[radial-gradient(#C49A45_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-[rgba(196,154,69,0.08)] rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <!-- Breadcrumb -->
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#81766D]">
            <a href="{{ route('home') }}" class="hover:text-[#C49A45] transition-colors">HOME</a>
            <span>/</span>
            <span class="text-[#81766D]">MORE</span>
            <span>/</span>
            <span class="text-[#C49A45] font-semibold">NUMEROLOGY CALCULATOR</span>
        </nav>

        <!-- Eyebrow -->
        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">NUMEROLOGY</span>
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
        </div>

        <!-- Heading -->
        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F]">
            Discover the Numbers Behind Your Birth
        </h1>

        <!-- Supporting Text -->
        <p class="text-xs sm:text-sm md:text-base text-[#81766D] max-w-2xl mx-auto font-light leading-relaxed">
            Explore traditional numerological calculations using your name and date of birth.
        </p>
    </div>
</section>

<!-- CALCULATOR SECTION -->
<section class="bg-[#FDFBF7] text-[#29211F] py-16 sm:py-24" 
         x-data="{
             fullName: '',
             dob: '',
             email: '',
             calculated: false,
             mulank: 0,
             mulankBreakdown: '',
             bhagyank: 0,
             bhagyankBreakdown: '',
             nameNumber: 0,
             nameBreakdown: '',
             interpretations: {
                 1: { planet: 'Sun (Surya)', title: 'Leadership & Vitality', desc: 'Represents initiative, individuality, ambition, and vital life energy in traditional numerical symbolism.' },
                 2: { planet: 'Moon (Chandra)', title: 'Intuition & Harmony', desc: 'Reflects sensitivity, cooperation, diplomacy, and emotional perception in traditional interpretations.' },
                 3: { planet: 'Jupiter (Guru)', title: 'Wisdom & Expansion', desc: 'Associated with knowledge, optimism, expression, and philosophical understanding.' },
                 4: { planet: 'Rahu', title: 'Structure & Discipline', desc: 'Symbolizes practical organization, perseverance, focus, and unconventional thinking.' },
                 5: { planet: 'Mercury (Budh)', title: 'Intellect & Communication', desc: 'Linked to versatility, quick comprehension, adaptability, and analytical skill.' },
                 6: { planet: 'Venus (Shukra)', title: 'Diplomacy & Harmony', desc: 'Reflects responsibility, aesthetic sense, empathy, and social balance.' },
                 7: { planet: 'Ketu', title: 'Analysis & Contemplation', desc: 'Associated with introspective depth, research, analytical investigation, and spiritual reflection.' },
                 8: { planet: 'Saturn (Shani)', title: 'Perseverance & Endurance', desc: 'Symbolizes patience, long-term discipline, executive capacity, and karma.' },
                 9: { planet: 'Mars (Mangal)', title: 'Courage & Drive', desc: 'Linked to energy, determination, protective instincts, and active conviction.' }
             },
             reduceToSingle(num) {
                 while (num > 9) {
                     let sum = 0;
                     String(num).split('').forEach(d => sum += parseInt(d));
                     num = sum;
                 }
                 return num;
             },
             calculate() {
                 if (!this.fullName || !this.dob) return;

                 // 1. Mulank (Day of Birth)
                 const dateParts = this.dob.split('-');
                 const dayVal = parseInt(dateParts[2]);
                 let dSum = 0;
                 String(dayVal).split('').forEach(d => dSum += parseInt(d));
                 this.mulank = this.reduceToSingle(dSum);
                 this.mulankBreakdown = `Day of birth (${dayVal}) → ${String(dayVal).split('').join(' + ')} = ${dSum} → Reduced: ${this.mulank}`;

                 // 2. Bhagyank (Full DOB Sum)
                 const allDigits = this.dob.replace(/-/g, '').split('');
                 let dobSum = 0;
                 allDigits.forEach(d => dobSum += parseInt(d));
                 this.bhagyank = this.reduceToSingle(dobSum);
                 this.bhagyankBreakdown = `Full Date (${this.dob}) → ${allDigits.join(' + ')} = ${dobSum} → Reduced: ${this.bhagyank}`;

                 // 3. Name Number (Pythagorean)
                 const letterMap = { a:1,b:2,c:3,d:4,e:5,f:6,g:7,h:8,i:9,j:1,k:2,l:3,m:4,n:5,o:6,p:7,q:8,r:9,s:1,t:2,u:3,v:4,w:5,x:6,y:7,z:8 };
                 let nameSum = 0;
                 let nameSeq = [];
                 this.fullName.toLowerCase().replace(/[^a-z]/g, '').split('').forEach(char => {
                     if (letterMap[char]) {
                         nameSum += letterMap[char];
                         nameSeq.push(`${char.toUpperCase()}(${letterMap[char]})`);
                     }
                 });
                 this.nameNumber = this.reduceToSingle(nameSum);
                 this.nameBreakdown = `Letter values: ${nameSeq.join(' + ')} = Total ${nameSum} → Reduced: ${this.nameNumber}`;

                 this.calculated = true;
             }
         }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">CALCULATE YOUR VIBRATIONS</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">Numerology Form</h2>
            <p class="text-xs sm:text-sm text-[#81766D]">Enter your details below to compute your Mulank, Bhagyank, and Name Number.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-6 sm:p-10 shadow-sm space-y-6">
            <form @submit.prevent="calculate()" class="space-y-6">
                <!-- Full Name -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">FULL NAME <span class="text-[#C49A45]">*</span></label>
                    <input type="text" 
                           x-model="fullName" 
                           required 
                           placeholder="Enter your full name as used in official documents" 
                           class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] placeholder-[#81766D] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                </div>

                <!-- Date of Birth & Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">DATE OF BIRTH <span class="text-[#C49A45]">*</span></label>
                        <input type="date" 
                               x-model="dob" 
                               required 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">EMAIL ADDRESS <span class="text-[#81766D] font-normal">(Optional)</span></label>
                        <input type="email" 
                               x-model="email" 
                               placeholder="name@example.com" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] placeholder-[#81766D] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                    </div>
                </div>

                <!-- Primary Submit CTA -->
                <button type="submit" 
                        class="w-full py-4 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] rounded-lg shadow hover:bg-[#351211] border border-[#D8C6A8] transition-all flex items-center justify-center space-x-2">
                    <span>CALCULATE NUMEROLOGY</span>
                    <span>→</span>
                </button>
            </form>
        </div>

        <!-- RESULTS SECTION -->
        <div x-show="calculated" 
             x-cloak 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="space-y-8">
            
            <div class="border-b border-[#D8C6A8] pb-4">
                <span class="text-xs font-bold uppercase tracking-widest text-[#C49A45]">NUMEROLOGY BREAKDOWN</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F] mt-1" x-text="'Calculation Results for ' + fullName"></h3>
            </div>

            <!-- 3 RESULT CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- 01. MULANK CARD -->
                <div class="bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-[#D8C6A8]/60 pb-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-[#C49A45]">MULANK (BIRTH NUMBER)</span>
                        <span class="text-2xl font-bold font-serif-luxury text-[#29211F]" x-text="mulank"></span>
                    </div>
                    <div class="space-y-2">
                        <span class="block text-xs font-semibold text-[#541F1D]" x-text="interpretations[mulank]?.planet"></span>
                        <h4 class="font-serif-luxury text-base font-bold text-[#29211F]" x-text="interpretations[mulank]?.title"></h4>
                        <p class="text-xs text-[#81766D] font-normal leading-relaxed" x-text="interpretations[mulank]?.desc"></p>
                    </div>
                </div>

                <!-- 02. BHAGYANK CARD -->
                <div class="bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-[#D8C6A8]/60 pb-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-[#C49A45]">BHAGYANK (LIFE PATH)</span>
                        <span class="text-2xl font-bold font-serif-luxury text-[#29211F]" x-text="bhagyank"></span>
                    </div>
                    <div class="space-y-2">
                        <span class="block text-xs font-semibold text-[#541F1D]" x-text="interpretations[bhagyank]?.planet"></span>
                        <h4 class="font-serif-luxury text-base font-bold text-[#29211F]" x-text="interpretations[bhagyank]?.title"></h4>
                        <p class="text-xs text-[#81766D] font-normal leading-relaxed" x-text="interpretations[bhagyank]?.desc"></p>
                    </div>
                </div>

                <!-- 03. NAME NUMBER CARD -->
                <div class="bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-[#D8C6A8]/60 pb-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-[#C49A45]">NAME NUMBER</span>
                        <span class="text-2xl font-bold font-serif-luxury text-[#29211F]" x-text="nameNumber"></span>
                    </div>
                    <div class="space-y-2">
                        <span class="block text-xs font-semibold text-[#541F1D]" x-text="interpretations[nameNumber]?.planet"></span>
                        <h4 class="font-serif-luxury text-base font-bold text-[#29211F]" x-text="interpretations[nameNumber]?.title"></h4>
                        <p class="text-xs text-[#81766D] font-normal leading-relaxed" x-text="interpretations[nameNumber]?.desc"></p>
                    </div>
                </div>
            </div>

            <!-- ARITHMETIC STEPS BREAKDOWN CARD -->
            <div class="bg-[#351211] text-[#F7F0E3] rounded-xl p-6 border border-[#C49A45]/30 space-y-3">
                <h4 class="font-serif-luxury text-lg font-bold text-[#C49A45]">Calculation Methodology & Arithmetic Steps</h4>
                <div class="space-y-2 text-xs text-[#EDE3D4] font-mono leading-relaxed">
                    <p><strong class="text-[#C49A45]">Mulank Calculation:</strong> <span x-text="mulankBreakdown"></span></p>
                    <p><strong class="text-[#C49A45]">Bhagyank Calculation:</strong> <span x-text="bhagyankBreakdown"></span></p>
                    <p><strong class="text-[#C49A45]">Name Calculation:</strong> <span x-text="nameBreakdown"></span></p>
                </div>
                <p class="text-[11px] text-[#C49A45] italic pt-2 border-t border-[#C49A45]/20">
                    Methodology: Traditional Pythagorean letter values (A=1, B=2, C=3...) combined with Sidereal birth-day digit reduction.
                </p>
            </div>

            <!-- DISCLAIMER -->
            <div class="p-4 bg-[#F7F0E3] border border-[#D8C6A8] rounded-lg text-xs text-[#81766D] leading-relaxed">
                <strong class="text-[#29211F] block font-semibold mb-0.5">Traditional Numerology Notice</strong>
                Numerical interpretations are presented as traditional symbolic insights based on classical numerology methods. They are intended for self-reflection and guidance rather than scientific assertion.
            </div>
        </div>

    </div>
</section>

@endsection
