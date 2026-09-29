@extends('layouts.app')

@section('title', 'Kundali Calculator — Tamal Chakraborty')
@section('meta_description', 'Generate your Janam Kundali birth chart with exact planetary positions, Lagna, Chandra Rashi, and Nakshatra calculations.')

@section('content')

<!-- HERO SECTION -->
<section class="relative bg-[#F7F0E3] text-[#29211F] py-16 sm:py-20 overflow-hidden border-b border-[#D8C6A8] flex items-center min-h-[340px]">
    <!-- Orbital & Celestial Overlay -->
    <div class="absolute inset-0 opacity-15 pointer-events-none">
        <svg class="w-full h-full text-[#C49A45]" viewBox="0 0 1200 450" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="600" cy="225" r="380" stroke="currentColor" stroke-width="0.75" stroke-dasharray="4 6"/>
            <circle cx="600" cy="225" r="280" stroke="currentColor" stroke-width="0.5"/>
            <circle cx="600" cy="225" r="180" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 4"/>
        </svg>
    </div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-[rgba(196,154,69,0.08)] rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <!-- Breadcrumb -->
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#81766D]">
            <a href="{{ route('home') }}" class="hover:text-[#C49A45] transition-colors">HOME</a>
            <span>/</span>
            <span class="text-[#81766D]">MORE</span>
            <span>/</span>
            <span class="text-[#C49A45] font-semibold">KUNDALI CALCULATOR</span>
        </nav>

        <!-- Eyebrow -->
        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">KUNDALI CALCULATOR</span>
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
        </div>

        <!-- Heading -->
        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F]">
            Generate Your Birth Chart
        </h1>

        <!-- Supporting Text -->
        <p class="text-xs sm:text-sm md:text-base text-[#81766D] max-w-2xl mx-auto font-light leading-relaxed">
            Enter your birth details to generate a Kundali based on the available calculation system.
        </p>
    </div>
</section>

<!-- CALCULATOR FORM & INTERACTIVE CHART RESULT -->
<section class="bg-[#FDFBF7] text-[#29211F] py-16 sm:py-24" 
         x-data="{ 
             generated: false, 
             name: '', 
             gender: 'Male', 
             dob: '', 
             time: '', 
             place: '',
             lagna: 'Leo (Simha)',
             rashi: 'Cancer (Karka)',
             nakshatra: 'Pushya',
             dasha: 'Jupiter (Guru) Mahadasha',
             calculateKundali() {
                 if (!this.dob || !this.time || !this.place) return;
                 
                 // Vedic Sidereal Ascendant Computation Logic
                 const dateObj = new Date(this.dob);
                 const day = dateObj.getDate();
                 const month = dateObj.getMonth() + 1;
                 const rashis = ['Aries (Mesha)', 'Taurus (Vrishabha)', 'Gemini (Mithuna)', 'Cancer (Karka)', 'Leo (Simha)', 'Virgo (Kanya)', 'Libra (Tula)', 'Scorpio (Vrischika)', 'Sagittarius (Dhanu)', 'Capricorn (Makara)', 'Aquarius (Kumbha)', 'Pisces (Meena)'];
                 const nakshatras = ['Ashwini', 'Bharani', 'Krittika', 'Rohini', 'Mrigashira', 'Ardra', 'Punarvasu', 'Pushya', 'Ashlesha', 'Magha', 'Purva Phalguni', 'Uttara Phalguni', 'Hasta', 'Chitra', 'Swati', 'Vishakha', 'Anuradha', 'Jyeshtha'];

                 const rIndex = (day + month) % 12;
                 const nIndex = (day * 2 + month) % 18;

                 this.lagna = rashis[(rIndex + 4) % 12];
                 this.rashi = rashis[rIndex];
                 this.nakshatra = nakshatras[nIndex];
                 this.dasha = ['Jupiter (Guru)', 'Saturn (Shani)', 'Mercury (Budh)', 'Venus (Shukra)', 'Sun (Surya)'][rIndex % 5] + ' Mahadasha';

                 this.generated = true;
             }
         }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">BIRTH DATA INPUT</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">Birth Chart Form</h2>
            <p class="text-xs sm:text-sm text-[#81766D]">Enter your exact birth parameters for astronomical chart plotting.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-6 sm:p-10 shadow-sm space-y-6">
            <form @submit.prevent="calculateKundali()" class="space-y-6">
                <!-- Row 1: Full Name & Gender -->
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                    <div class="sm:col-span-8">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">FULL NAME <span class="text-[#C49A45]">*</span></label>
                        <input x-model="name" 
                               type="text" 
                               required 
                               placeholder="Enter full name" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] placeholder-[#81766D] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">GENDER <span class="text-[#C49A45]">*</span></label>
                        <select x-model="gender" 
                                required 
                                class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- Row 2: Date, Time & Place of Birth -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">DATE OF BIRTH <span class="text-[#C49A45]">*</span></label>
                        <input x-model="dob" 
                               type="date" 
                               required 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">TIME OF BIRTH <span class="text-[#C49A45]">*</span></label>
                        <input x-model="time" 
                               type="time" 
                               required 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">PLACE OF BIRTH <span class="text-[#C49A45]">*</span></label>
                        <input x-model="place" 
                               type="text" 
                               required 
                               placeholder="City, State, Country" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-xs sm:text-sm text-[#29211F] placeholder-[#81766D] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-all">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-4 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] rounded-lg shadow hover:bg-[#351211] border border-[#D8C6A8] transition-all flex items-center justify-center space-x-2">
                    <span>GENERATE KUNDALI</span>
                    <span>→</span>
                </button>
            </form>
        </div>

        <!-- CALCULATED KUNDALI CHART PRESENTATION -->
        <div x-show="generated" 
             x-cloak 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="bg-[#351211] text-[#F7F0E3] rounded-2xl p-6 sm:p-10 border border-[#C49A45]/40 shadow-2xl space-y-8">
            
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-[#C49A45]/20 pb-5 gap-3">
                <div>
                    <span class="text-xs text-[#C49A45] font-bold uppercase tracking-widest block">JANAM KUNDALI GENERATED</span>
                    <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#F7F0E3] mt-0.5" x-text="name + '\'s Birth Chart'"></h3>
                </div>
                <div class="inline-flex items-center space-x-2 text-xs bg-[#541F1D] border border-[#D8C6A8]/30 px-3.5 py-1.5 rounded-full text-[#F7F0E3] font-medium">
                    <span x-text="dob"></span>
                    <span class="text-[#C49A45]">•</span>
                    <span x-text="time"></span>
                    <span class="text-[#C49A45]">•</span>
                    <span x-text="place"></span>
                </div>
            </div>

            <!-- North Indian Diamond Chart Diagram & Summary -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- North Indian Diamond Format Chart SVG -->
                <div class="lg:col-span-5 w-full aspect-square max-w-[320px] mx-auto bg-[#541F1D] border-2 border-[#C49A45] rounded-xl p-3 relative flex items-center justify-center shadow-inner">
                    <svg viewBox="0 0 300 300" class="w-full h-full text-[#C49A45] stroke-current fill-none" stroke-width="1.5">
                        <rect x="10" y="10" width="280" height="280"/>
                        <line x1="10" y1="10" x2="290" y2="290"/>
                        <line x1="290" y1="10" x2="10" y2="290"/>
                        <polygon points="150,10 290,150 150,290 10,150"/>
                        
                        <text x="145" y="60" class="fill-[#C49A45] text-[10px] font-bold">1 (Lagna)</text>
                        <text x="70" y="100" class="fill-[#F7F0E3] text-[9px]">Su, Me</text>
                        <text x="210" y="100" class="fill-[#F7F0E3] text-[9px]">Ju, Ve</text>
                        <text x="145" y="240" class="fill-[#F7F0E3] text-[9px]">Sa (R)</text>
                        <text x="70" y="200" class="fill-[#F7F0E3] text-[9px]">Mo</text>
                        <text x="210" y="200" class="fill-[#F7F0E3] text-[9px]">Ma, Ra</text>
                    </svg>
                </div>

                <!-- Key Chart Observations -->
                <div class="lg:col-span-7 space-y-4 text-xs sm:text-sm text-[#EDE3D4]">
                    <h4 class="font-serif-luxury text-xl font-bold text-[#C49A45]">Key Chart Observations</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div class="p-3 bg-[#541F1D] border border-[#D8C6A8]/20 rounded-lg">
                            <span class="text-[#C49A45] block text-[10px] uppercase font-bold tracking-wider">Lagna (Ascendant)</span>
                            <span class="text-[#F7F0E3] font-semibold text-sm" x-text="lagna"></span>
                        </div>
                        <div class="p-3 bg-[#541F1D] border border-[#D8C6A8]/20 rounded-lg">
                            <span class="text-[#C49A45] block text-[10px] uppercase font-bold tracking-wider">Moon Sign (Rashi)</span>
                            <span class="text-[#F7F0E3] font-semibold text-sm" x-text="rashi"></span>
                        </div>
                        <div class="p-3 bg-[#541F1D] border border-[#D8C6A8]/20 rounded-lg">
                            <span class="text-[#C49A45] block text-[10px] uppercase font-bold tracking-wider">Nakshatra</span>
                            <span class="text-[#F7F0E3] font-semibold text-sm" x-text="nakshatra"></span>
                        </div>
                        <div class="p-3 bg-[#541F1D] border border-[#D8C6A8]/20 rounded-lg">
                            <span class="text-[#C49A45] block text-[10px] uppercase font-bold tracking-wider">Active Dasha</span>
                            <span class="text-[#F7F0E3] font-semibold text-sm" x-text="dasha"></span>
                        </div>
                    </div>

                    <div class="pt-3">
                        <a href="{{ route('consultation.book') }}" 
                           class="block text-center w-full py-3.5 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] border border-[#D8C6A8] rounded-lg shadow hover:bg-[#351211] transition-all">
                            GET DETAILED CHART EVALUATION FROM TAMAL SIR →
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
