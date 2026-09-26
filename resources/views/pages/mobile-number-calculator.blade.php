@extends('layouts.app')

@section('title', 'Mobile Number Calculator — Tamal Chakraborty')
@section('meta_description', 'Analyze your phone number vibrational frequency and compatibility using traditional Vedic and Pythagorean numerology logic.')

@section('content')

<!-- HERO SECTION -->
<section class="relative bg-[#0B1018] text-[#FDFBF7] py-16 sm:py-20 overflow-hidden border-b border-[rgba(212,175,55,0.25)] flex items-center min-h-[360px] max-h-[440px]">
    <!-- Celestial & Numerical Overlay -->
    <div class="absolute inset-0 opacity-15 pointer-events-none bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-[rgba(212,175,55,0.05)] rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <!-- Breadcrumb -->
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#9A7422]">
            <a href="{{ route('home') }}" class="hover:text-[#D4AF37] transition-colors">HOME</a>
            <span>/</span>
            <span class="text-[#D4AF37]">MORE</span>
            <span>/</span>
            <span class="text-[#D4AF37] font-semibold">MOBILE NUMBER CALCULATOR</span>
        </nav>

        <!-- Eyebrow -->
        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#D4AF37]">MOBILE NUMBER NUMEROLOGY</span>
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
        </div>

        <!-- Heading -->
        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#FDFBF7]">
            Explore Your Mobile Number Through Numerology
        </h1>

        <!-- Supporting Text -->
        <p class="text-xs sm:text-sm md:text-base text-[#D7DCE3] max-w-2xl mx-auto font-light leading-relaxed">
            Enter your mobile number to calculate its traditional numerological total and explore the associated interpretation.
        </p>
    </div>
</section>

<!-- CALCULATOR SECTION -->
<section class="bg-[#FDFBF7] text-[#17202D] py-16 sm:py-24" 
         x-data="{
             mobileInput: '',
             dob: '',
             calculated: false,
             cleanDigits: [],
             compoundTotal: 0,
             singleDigit: 0,
             arithmeticStep1: '',
             arithmeticStep2: '',
             dobCompatibility: '',
             interpretations: {
                 1: { planet: 'Sun (Surya)', theme: 'Leadership & Direct Action', desc: 'A total of 1 is traditionally associated with leadership, independence, executive decisions, and clear communication.' },
                 2: { planet: 'Moon (Chandra)', theme: 'Relationships & Coordination', desc: 'Reflects cooperative energy, diplomacy, sensitivity, and supportive interpersonal connections.' },
                 3: { planet: 'Jupiter (Guru)', theme: 'Growth, Advice & Learning', desc: 'Linked to consultation, advisory work, expansion, public speaking, and creative energy.' },
                 4: { planet: 'Rahu', theme: 'Systematic & Technical Work', desc: 'Associated with technical precision, structure, practical execution, and systematic tasks.' },
                 5: { planet: 'Mercury (Budh)', theme: 'Fast Communication & Commerce', desc: 'Highly favorable for commercial transactions, networking, quick exchanges, and multi-tasking.' },
                 6: { planet: 'Venus (Shukra)', theme: 'Harmony & Aesthetics', desc: 'Symbolizes elegance, luxury, relationship harmony, customer satisfaction, and diplomacy.' },
                 7: { planet: 'Ketu', theme: 'Analytical Research & Reflection', desc: 'Reflects research, analytical thinking, specialized knowledge, and deep contemplation.' },
                 8: { planet: 'Saturn (Shani)', theme: 'Endurance & Business Operations', desc: 'Linked to organizational perseverance, long-term commitment, law, and administrative stability.' },
                 9: { planet: 'Mars (Mangal)', theme: 'Courage, Drive & Energy', desc: 'Associated with high vitality, prompt action, courage, and protective management.' }
             },
             reduceToSingle(num) {
                 while (num > 9) {
                     let sum = 0;
                     String(num).split('').forEach(d => sum += parseInt(d));
                     num = sum;
                 }
                 return num;
             },
             analyze() {
                 if (!this.mobileInput) return;

                 // Normalize phone number (strip spaces, symbols, country codes if entered)
                 const rawDigits = this.mobileInput.replace(/[^0-9]/g, '');
                 if (rawDigits.length === 0) return;

                 // We use the full digits entered by user
                 this.cleanDigits = rawDigits.split('').map(Number);
                 
                 // Step 1: Compound Total
                 let sum = 0;
                 this.cleanDigits.forEach(d => sum += d);
                 this.compoundTotal = sum;
                 this.arithmeticStep1 = `${this.cleanDigits.join(' + ')} = ${this.compoundTotal}`;

                 // Step 2: Reduced Single Digit
                 this.singleDigit = this.reduceToSingle(this.compoundTotal);
                 if (this.compoundTotal > 9) {
                     const digits2 = String(this.compoundTotal).split('');
                     this.arithmeticStep2 = `${digits2.join(' + ')} = ${this.singleDigit}`;
                 } else {
                     this.arithmeticStep2 = `Single Digit = ${this.singleDigit}`;
                 }

                 // Optional DOB Compatibility Check
                 if (this.dob) {
                     const dayVal = parseInt(this.dob.split('-')[2]);
                     let dSum = 0;
                     String(dayVal).split('').forEach(d => dSum += parseInt(d));
                     const mulank = this.reduceToSingle(dSum);

                     if (mulank === this.singleDigit) {
                         this.dobCompatibility = `Excellent Harmony: Your Birth Number (Mulank ${mulank}) directly matches your Mobile Single Digit (${this.singleDigit}), reinforcing your primary core vibrations.`;
                     } else if (Math.abs(mulank - this.singleDigit) % 2 === 0) {
                         this.dobCompatibility = `Harmonious Synergy: Your Birth Number (${mulank}) and Mobile Digit (${this.singleDigit}) share compatible numerical polarities.`;
                     } else {
                         this.dobCompatibility = `Complementary Combination: Your Birth Number (${mulank}) and Mobile Digit (${this.singleDigit}) bring complementary elemental energies into your daily communications.`;
                     }
                 } else {
                     this.dobCompatibility = '';
                 }

                 this.calculated = true;
             }
         }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">PHONE NUMBER ANALYSIS</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">Mobile Numerology Form</h2>
            <p class="text-xs sm:text-sm text-[#596273]">Enter your mobile number to compute its digit total, compound number, and single-digit ruler.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white border border-[#17202D]/15 rounded-2xl p-6 sm:p-10 shadow-sm space-y-6">
            <form @submit.prevent="analyze()" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                    <!-- Mobile Number -->
                    <div class="sm:col-span-8">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#17202D] mb-2">MOBILE NUMBER <span class="text-[#B08A2E]">*</span></label>
                        <input type="text" 
                               x-model="mobileInput" 
                               required 
                               placeholder="e.g. 98765 43210" 
                               class="w-full bg-[#FFFFFF] border border-[#17202D]/15 rounded-lg px-4 py-3 text-xs sm:text-sm text-[#17202D] placeholder-[#8A929E] focus:outline-none focus:border-[#B08A2E] focus:ring-1 focus:ring-[#B08A2E] transition-all">
                    </div>

                    <!-- Date of Birth (Optional) -->
                    <div class="sm:col-span-4">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#17202D] mb-2">DATE OF BIRTH <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <input type="date" 
                               x-model="dob" 
                               class="w-full bg-[#FFFFFF] border border-[#17202D]/15 rounded-lg px-4 py-3 text-xs sm:text-sm text-[#17202D] focus:outline-none focus:border-[#B08A2E] focus:ring-1 focus:ring-[#B08A2E] transition-all">
                    </div>
                </div>

                <!-- Primary Submit CTA -->
                <button type="submit" 
                        class="w-full py-4 text-xs font-bold uppercase tracking-widest text-[#0B1018] bg-[#B08A2E] rounded-lg shadow hover:bg-[#9A7422] hover:text-[#FDFBF7] transition-all flex items-center justify-center space-x-2">
                    <span>ANALYSE MOBILE NUMBER</span>
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
            
            <div class="border-b border-[#17202D]/15 pb-4">
                <span class="text-xs font-bold uppercase tracking-widest text-[#B08A2E]">MOBILE NUMEROLOGY ANALYSIS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D] mt-1" x-text="'Results for Mobile: ' + mobileInput"></h3>
            </div>

            <!-- RESULT CARDS GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- CARD 1: NUMERICAL TOTAL & RULER -->
                <div class="bg-white border border-[#17202D]/10 rounded-xl p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-[#17202D]/10 pb-3">
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-[#B08A2E]">REDUCED SINGLE DIGIT</span>
                            <span class="block text-xs text-[#596273]" x-text="'Compound Total: ' + compoundTotal"></span>
                        </div>
                        <span class="text-3xl font-bold font-serif-luxury text-[#17202D]" x-text="singleDigit"></span>
                    </div>
                    
                    <div class="space-y-2">
                        <span class="block text-xs font-semibold text-[#17202D]" x-text="'Ruling Planet: ' + interpretations[singleDigit]?.planet"></span>
                        <h4 class="font-serif-luxury text-lg font-bold text-[#B08A2E]" x-text="interpretations[singleDigit]?.theme"></h4>
                        <p class="text-xs text-[#596273] font-normal leading-relaxed" x-text="interpretations[singleDigit]?.desc"></p>
                    </div>
                </div>

                <!-- CARD 2: ARITHMETIC BREAKDOWN & DOB SYNERGY -->
                <div class="bg-white border border-[#17202D]/10 rounded-xl p-6 shadow-sm space-y-4">
                    <div class="border-b border-[#17202D]/10 pb-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-[#B08A2E]">CALCULATION ARITHMETIC</span>
                        <h4 class="font-serif-luxury text-base font-bold text-[#17202D] mt-0.5">Digit Addition Steps</h4>
                    </div>

                    <div class="space-y-3 text-xs text-[#17202D]">
                        <div class="p-3 bg-[#FAF8F5] border border-[#17202D]/10 rounded-lg space-y-1">
                            <span class="text-[10px] font-bold text-[#B08A2E] uppercase block">Step 1: Sum of Digits</span>
                            <span class="font-mono text-xs block text-[#17202D]" x-text="arithmeticStep1"></span>
                        </div>

                        <div class="p-3 bg-[#FAF8F5] border border-[#17202D]/10 rounded-lg space-y-1">
                            <span class="text-[10px] font-bold text-[#B08A2E] uppercase block">Step 2: Single Digit Reduction</span>
                            <span class="font-mono text-xs block text-[#17202D]" x-text="arithmeticStep2"></span>
                        </div>

                        <template x-if="dobCompatibility">
                            <div class="p-3 bg-[#0B1018] text-[#FDFBF7] rounded-lg border border-[#B08A2E]/30 space-y-1">
                                <span class="text-[10px] font-bold text-[#D4AF37] uppercase block">Birth Chart Synergy</span>
                                <p class="text-xs text-[#D7DCE3] leading-relaxed" x-text="dobCompatibility"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- TRADITIONAL NOTICE -->
            <div class="p-4 bg-[#FAF8F5] border border-[#17202D]/10 rounded-lg text-xs text-[#596273] leading-relaxed">
                <strong class="text-[#17202D] block font-semibold mb-0.5">Traditional Mobile Numerology Notice</strong>
                Mobile number numerology offers a traditional symbolic framework for evaluating number totals. Interpretations are intended for reflective interest and personal alignment rather than empirical assertions.
            </div>
        </div>

    </div>
</section>

@endsection
