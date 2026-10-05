<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Birth Chart Analysis
        $birthChart = Service::where('slug', 'birth-chart')->first();
        if ($birthChart) {
            $birthChart->update([
                'is_active' => true,
                'hero_eyebrow' => 'JANMA KUNDLI READING',
                'hero_title' => 'Vedic Birth Chart Analysis',
                'hero_description' => 'Understand your birth chart, planetary positions, Lagna, Rashi, and major Dasha cycles through classical Vedic astrology interpretation.',
                'hero_visible' => true,
                'intro_eyebrow' => 'DEEP ASTROLOGICAL EXAMINATION',
                'intro_heading' => 'Beyond Generic Horoscope Readings: The Power of a Personalized Janma Kundli',
                'full_description' => '<p>A <strong>Vedic birth chart (Janma Kundli)</strong> is a precise astronomical snapshot of the cosmos calculated for the exact moment and geographic coordinates of your birth. Unlike generic sun-sign horoscopes found in popular media, an authentic <strong>birth chart analysis</strong> examines the twelve houses (Bhavas), nine primary grahas (planets), Lagna (ascendant), Chandra Rashi (Moon sign), and twenty-seven Nakshatras (lunar mansions).</p><p>In classical Parashari Vedic Astrology, your birth chart serves as a structural blueprint of your life’s potential, innate inclinations, karmic timing, and emotional disposition. A comprehensive Kundli reading evaluates how planetary forces interact within your specific chart to influence career growth, relationship harmony, financial stability, health tendencies, and spiritual development.</p>',
                'main_content_visible' => true,
                'covers_eyebrow' => 'ANALYTICAL SCOPE',
                'covers_title' => 'What This Consultation Covers',
                'covers_items' => [
                    ['number' => '01', 'title' => 'Lagna & Ascendant Lord', 'description' => 'Detailed assessment of your 1st house, ascendant sign, and Lagnesha to understand physical vitality, temperament, and core life orientation.'],
                    ['number' => '02', 'title' => 'Chandra Rashi & Nakshatra', 'description' => 'Evaluation of Moon placement and lunar constellation to analyze psychological patterns, emotional resilience, and instinctual responses.'],
                    ['number' => '03', 'title' => 'Vimshottari Dasha Cycles', 'description' => 'In-depth calculation of your major (Mahadasha) and minor (Antardasha) planetary periods to determine active time windows for major life developments.']
                ],
                'covers_visible' => true,
                'benefits_eyebrow' => 'PRACTICAL VALUE',
                'benefits_title' => 'Why a Birth Chart Analysis Matters',
                'benefits_items' => [
                    ['title' => 'Clarity During Transition Periods', 'description' => 'When facing career shifts, business decisions, or personal crossroads, your chart reveals underlying planetary timing, helping you act with confidence rather than uncertainty.'],
                    ['title' => 'Understanding Natural Strengths', 'description' => 'Identify innate planetary Yogas and favorable house placements that indicate professional aptitude, financial avenues, and personal gifts.']
                ],
                'benefits_visible' => true,
                'process_eyebrow' => 'CONSULTATION PROCESS',
                'process_title' => 'How the Janma Kundli Session Works',
                'process_items' => [
                    ['step' => '1', 'title' => 'Birth Details', 'description' => 'Submit date, exact time, and birthplace.'],
                    ['step' => '2', 'title' => 'Chart Calculation', 'description' => 'Sidereal computation of Kundli & Dashas.'],
                    ['step' => '3', 'title' => '1-on-1 Consultation', 'description' => '45-minute live audio/video discussion.'],
                    ['step' => '4', 'title' => 'Practical Remedies', 'description' => 'Time-tested lifestyle & gemstone guidance.']
                ],
                'process_visible' => true,
                'dimensions_eyebrow' => 'LIFE DIMENSIONS',
                'dimensions_title' => 'Key Life Dimensions Analyzed',
                'dimensions_items' => [
                    ['title' => '1. Career & Profession (10th House)', 'description' => 'Evaluation of career direction, job stability, leadership capacity, and professional timing.'],
                    ['title' => '2. Wealth & Finances (2nd & 11th)', 'description' => 'Analysis of income potential, financial stability, asset accumulation, and financial timing.'],
                    ['title' => '3. Relationships & Marriage (7th House)', 'description' => 'Understanding partnership compatibility, marital harmony, and interpersonal relationship dynamics.'],
                    ['title' => '4. Health & Vitality (1st & 6th)', 'description' => 'Astrological indications regarding constitution, stress management, and physical vitality windows.'],
                    ['title' => '5. Higher Education & Wisdom (5th & 9th)', 'description' => 'Guidance for academic focus, higher learning, intellectual aptitude, and mentorship opportunities.'],
                    ['title' => '6. Spiritual Growth & Life Direction (9th & 12th)', 'description' => 'Understanding your inner life purpose, philosophical inclinations, and personal growth periods.']
                ],
                'dimensions_visible' => true,
                'who_for_title' => 'Who This Consultation Is For',
                'who_for_items' => [
                    'Individuals seeking a comprehensive foundational understanding of their birth chart.',
                    'Anyone navigating major career, business, relationship, or relocation decisions.',
                    'People experiencing period changes (Dasha Sandhi) or major transit shifts.',
                    'Seekers who want authentic, practical Vedic advice without fear-based assertions.'
                ],
                'who_for_visible' => true,
                'questions_title' => 'Questions Frequently Explored in This Session',
                'questions_items' => [
                    '"What are the most prominent planetary strengths and Yogas in my birth chart?"',
                    '"Which planetary Mahadasha period am I running and what life areas does it activate?"',
                    '"What career paths align best with my 10th house, Saturn, and Mercury placements?"',
                    '"What practical remedies can help harmonize challenging planetary positions?"'
                ],
                'questions_visible' => true,
                'methodology_title' => 'Astrological Approach & Methodology',
                'methodology_content' => 'Tamal Chakraborty practices classical Parashara and Jaimini Vedic Astrology using Lahiri Ayanamsha (Sidereal Zodiac). Every consultation combines rigorous astronomical calculation with compassionate, realistic guidance. Predictions are never presented as unalterable fatalism; rather, astrology is treated as an enlightening mirror to understand timing and exercise conscious free will.',
                'methodology_visible' => true,
                'expectations_title' => 'What You Can Expect From the Session',
                'expectations_items' => [
                    ['title' => '100% Confidentiality', 'description' => 'Your personal details and discussion remain strictly private.'],
                    ['title' => 'Clear Answers', 'description' => 'Direct answers to your specific queries without ambiguity.'],
                    ['title' => 'Authentic Remedies', 'description' => 'Practical, non-superstitious remedial guidance.']
                ],
                'expectations_visible' => true,
                'faqs_eyebrow' => 'FREQUENTLY ASKED QUESTIONS',
                'faqs_title' => 'Birth Chart FAQ',
                'faqs_items' => [
                    ['question' => 'What information do I need to provide for a birth chart reading?', 'answer' => 'You need to provide your exact Date of Birth, exact Time of Birth (including AM/PM), and Place of Birth (City/State). Accurate birth time is important for calculating the precise Lagna (ascendant) and house cusps.'],
                    ['question' => 'What if I do not know my exact birth time?', 'answer' => 'If your birth time is approximate, planetary positions in Rashis and major Dasha cycles can still be calculated. For exact house placements, birth time rectification or Prashna (Horary) methods can be applied during the consultation.'],
                    ['question' => 'How is Vedic Birth Chart Analysis different from Western astrology?', 'answer' => 'Vedic Astrology (Jyotish) utilizes the Sidereal Zodiac based on fixed star constellations and incorporates Nakshatras and Vimshottari Dasha planetary periods for precise predictive timing, whereas Western astrology uses the Tropical Zodiac.']
                ],
                'faqs_visible' => true,
                'cta_eyebrow' => '• SCHEDULE YOUR SESSION •',
                'cta_title' => 'Ready to Explore Your Janma Kundli?',
                'cta_description' => 'Book a 1-on-1 private consultation with Tamal Chakraborty to understand your birth chart, Dashas, and key life directions.',
                'cta_button_text' => 'BOOK BIRTH CHART CONSULTATION',
                'cta_url' => route('consultation.book', [], false),
                'cta_visible' => true,
                'seo_title' => 'Vedic Birth Chart Analysis & Janma Kundli Reading — Tamal Chakraborty',
                'seo_meta_description' => 'In-depth Vedic birth chart analysis (Janma Kundli reading). Explore planetary positions, Lagna, Rashi, Nakshatras, Mahadasha cycles, and personalized life guidance with Tamal Chakraborty.',
            ]);
        }

        // 2. Transit & Timing Analysis
        $transit = Service::where('slug', 'transit-timing')->first();
        if ($transit) {
            $transit->update([
                'is_active' => true,
                'hero_eyebrow' => 'GOCHAR & PLANETARY TIMING',
                'hero_title' => 'Transit & Timing Analysis',
                'hero_description' => 'Understand planetary transits (Gochar), major planetary shifts, and timing cycles to navigate key decisions with astrological perspective.',
                'hero_visible' => true,
                'intro_eyebrow' => 'TIMING THE WHEEL OF TIME',
                'intro_heading' => 'Understanding Gochar: How Current Planetary Movements Interact With Your Natal Chart',
                'full_description' => '<p>While your birth chart represents the static blueprint of your life, <strong>planetary transits (Gochar)</strong> represent the dynamic, ever-moving cosmos. In Vedic Astrology, transits of major slow-moving planets—specifically <strong>Jupiter (Guru), Saturn (Shani), and the nodal axis of Rahu and Ketu</strong>—act as triggers that activate the promises dormant in your Janma Kundli.</p><p>A dedicated <strong>Transit & Timing Analysis</strong> evaluates how current planetary movements form aspects and house placements relative to your ascendant (Lagna) and Moon sign (Chandra Rashi). This analysis provides valuable perspective during times of transition, helping you discern periods that favor bold initiative versus phases that require patience and preparation.</p>',
                'main_content_visible' => true,
                'covers_eyebrow' => 'ANALYTICAL SCOPE',
                'covers_title' => 'What This Transit Consultation Covers',
                'covers_items' => [
                    ['number' => '01', 'title' => 'Saturn Transit (Shani Gochar)', 'description' => 'Evaluation of Saturn’s 2.5-year house transit, Sade Sati phases, or Dhaiya to understand areas requiring discipline and structural focus.'],
                    ['number' => '02', 'title' => 'Jupiter Transit (Guru Gochar)', 'description' => 'Assessment of Jupiter’s annual transit aspects to identify growth opportunities, wisdom, financial expanding phases, and mentorship.'],
                    ['number' => '03', 'title' => 'Rahu & Ketu Axis Shifts', 'description' => 'Analysis of the 18-month lunar node transits highlighting innovative opportunities, karmic adjustments, and areas of focus.']
                ],
                'covers_visible' => true,
                'benefits_eyebrow' => 'PRACTICAL VALUE',
                'benefits_title' => 'Why Astrological Timing Matters',
                'benefits_items' => [
                    ['title' => 'Opportunity Windows', 'description' => 'Identify time windows when planetary transits harmonize with your Dasha periods, optimizing career moves, business launches, or financial investments.'],
                    ['title' => 'Proactive Preparation', 'description' => 'Understand challenging transit aspects in advance to manage stress, avoid unnecessary conflicts, and build resilience.']
                ],
                'benefits_visible' => true,
                'process_eyebrow' => 'CONSULTATION PROCESS',
                'process_title' => 'How the Transit Analysis Session Works',
                'process_items' => [
                    ['step' => '1', 'title' => 'Birth Details', 'description' => 'Provide exact date, time, and place of birth.'],
                    ['step' => '2', 'title' => 'Transit Computation', 'description' => 'Calculation of current & upcoming planetary positions.'],
                    ['step' => '3', 'title' => '1-on-1 Guidance', 'description' => '45-minute live consultation on active timing.'],
                    ['step' => '4', 'title' => 'Remedial Strategy', 'description' => 'Practical remedial measures for smooth transit phases.']
                ],
                'process_visible' => true,
                'dimensions_eyebrow' => 'TIMING DIMENSIONS',
                'dimensions_title' => 'Key Timing Windows Analyzed',
                'dimensions_items' => [
                    ['title' => '1. Career & Business Transitions', 'description' => 'Timing job changes, promotions, new business launches, and major career pivot points.'],
                    ['title' => '2. Financial & Asset Investments', 'description' => 'Navigating favorable phases for property purchase, investment decisions, and financial growth.'],
                    ['title' => '3. Relationship & Family Timing', 'description' => 'Understanding relationship transit triggers, marriage timing, and family development phases.'],
                    ['title' => '4. Relocation & Foreign Travel', 'description' => 'Evaluating 9th and 12th house transits for travel, higher education, or overseas relocation.']
                ],
                'dimensions_visible' => true,
                'who_for_title' => 'Who This Consultation Is For',
                'who_for_items' => [
                    'Individuals planning major career changes, business investments, or life decisions.',
                    'People currently undergoing Saturn Sade Sati or major Rahu-Ketu transit shifts.',
                    'Anyone seeking clarity on upcoming time windows and favorable periods.',
                    'Seekers wanting time-tested Vedic perspective on current life challenges.'
                ],
                'who_for_visible' => true,
                'questions_title' => 'Questions Frequently Explored in This Session',
                'questions_items' => [
                    '"How is current Saturn transit (Shani Gochar) affecting my career and finances?"',
                    '"When is the most favorable window in the next 12 months for a job change or business launch?"',
                    '"What impact will upcoming Jupiter transit have on my relationship and personal growth?"',
                    '"What specific remedial measures can cushion challenging transit periods?"'
                ],
                'questions_visible' => true,
                'methodology_title' => 'Astrological Approach & Methodology',
                'methodology_content' => 'Tamal Chakraborty evaluates transits in relation to your natal Lagna and Chandra Rashi using Lahiri Ayanamsha. Transits are never analyzed in isolation; they are synthesized with your active Vimshottari Mahadasha to provide practical, realistic clarity.',
                'methodology_visible' => true,
                'expectations_title' => 'What You Can Expect From the Session',
                'expectations_items' => [
                    ['title' => '100% Confidentiality', 'description' => 'Your personal chart and discussions are strictly private.'],
                    ['title' => 'Clear Timeline', 'description' => 'Specific timing windows explained in simple, practical language.'],
                    ['title' => 'Practical Guidance', 'description' => 'Actionable advice for leveraging favorable timing.']
                ],
                'expectations_visible' => true,
                'faqs_eyebrow' => 'FREQUENTLY ASKED QUESTIONS',
                'faqs_title' => 'Transit & Timing FAQ',
                'faqs_items' => [
                    ['question' => 'How often should I get a transit analysis?', 'answer' => 'An annual transit review or a session prior to major life decisions (career shift, business expansion, marriage) is recommended.'],
                    ['question' => 'What is the difference between Dasha and Transit?', 'answer' => 'Dasha indicates the internal karmic agenda and operating climate, while Transit (Gochar) represents the external cosmic weather activating that climate.']
                ],
                'faqs_visible' => true,
                'cta_eyebrow' => '• SCHEDULE YOUR SESSION •',
                'cta_title' => 'Ready to Understand Your Planetary Timing?',
                'cta_description' => 'Book a 1-on-1 private consultation with Tamal Chakraborty to analyze current transits and time your key life decisions.',
                'cta_button_text' => 'BOOK TRANSIT CONSULTATION',
                'cta_url' => route('consultation.book', [], false),
                'cta_visible' => true,
                'seo_title' => 'Planetary Transit & Timing Analysis (Gochar Astrology) — Tamal Chakraborty',
                'seo_meta_description' => 'Explore planetary transits (Gochar), Saturn transit, Jupiter transit, Rahu-Ketu shifts, and astrological timing for major career and life decisions with Tamal Chakraborty.',
            ]);
        }

        // Fill remaining services with clean defaults if empty
        $otherSlugs = ['career-guidance', 'business-guidance', 'life-direction', 'astrology-learning'];
        foreach ($otherSlugs as $slug) {
            $serv = Service::where('slug', $slug)->first();
            if ($serv) {
                $serv->update([
                    'is_active' => true,
                    'hero_eyebrow' => strtoupper($serv->badge ?? $serv->title),
                    'hero_title' => $serv->title,
                    'hero_description' => $serv->short_description,
                    'hero_visible' => true,
                    'intro_eyebrow' => 'ASTROLOGICAL PERSPECTIVE',
                    'intro_heading' => 'Comprehensive ' . $serv->title . ' Consultation',
                    'full_description' => '<p>' . e($serv->full_description) . '</p>',
                    'main_content_visible' => true,
                    'covers_eyebrow' => 'CONSULTATION SCOPE',
                    'covers_title' => 'What This Consultation Covers',
                    'covers_items' => [
                        ['number' => '01', 'title' => 'Birth Chart Analysis', 'description' => 'In-depth evaluation of key planetary placements affecting ' . strtolower($serv->title) . '.'],
                        ['number' => '02', 'title' => 'Dasha & Timing', 'description' => 'Assessment of active planetary Mahadasha and Antardasha periods.'],
                        ['number' => '03', 'title' => 'Practical Guidance', 'description' => 'Realistic remedies, strategic timing, and actionable insights.']
                    ],
                    'covers_visible' => true,
                    'benefits_eyebrow' => 'PRACTICAL VALUE',
                    'benefits_title' => 'Why This Consultation Matters',
                    'benefits_items' => [
                        ['title' => 'Clarity & Perspective', 'description' => 'Gain clear, objective understanding of your chart potential.'],
                        ['title' => 'Strategic Timing', 'description' => 'Identify optimal time windows for important decisions.']
                    ],
                    'benefits_visible' => true,
                    'process_eyebrow' => 'CONSULTATION PROCESS',
                    'process_title' => 'How the Session Works',
                    'process_items' => [
                        ['step' => '1', 'title' => 'Birth Details', 'description' => 'Provide accurate date, time, and place of birth.'],
                        ['step' => '2', 'title' => 'Chart Preparation', 'description' => 'Detailed calculation of chart and timing cycles.'],
                        ['step' => '3', 'title' => 'Live Discussion', 'description' => '1-on-1 confidential video/audio consultation.'],
                        ['step' => '4', 'title' => 'Remedial Plan', 'description' => 'Customized remedial guidance and actionable recommendations.']
                    ],
                    'process_visible' => true,
                    'dimensions_eyebrow' => 'KEY AREAS',
                    'dimensions_title' => 'Key Areas Analyzed',
                    'dimensions_items' => [
                        ['title' => '1. Core Aptitude & Inclinations', 'description' => 'Understanding innate strengths and planetary influences.'],
                        ['title' => '2. Timing Windows', 'description' => 'Evaluating favorable periods for key milestones.']
                    ],
                    'dimensions_visible' => true,
                    'who_for_title' => 'Who This Consultation Is For',
                    'who_for_items' => [
                        'Individuals seeking clarity on ' . strtolower($serv->title) . '.',
                        'Anyone navigating transitional periods or key decision points.',
                        'Seekers wanting authentic, non-superstitious Vedic advice.'
                    ],
                    'who_for_visible' => true,
                    'questions_title' => 'Questions Frequently Explored',
                    'questions_items' => [
                        '"What are the primary planetary factors influencing my current situation?"',
                        '"When is the most favorable time for my upcoming plans?"',
                        '"What practical remedies can assist my progress?"'
                    ],
                    'questions_visible' => true,
                    'methodology_title' => 'Astrological Approach & Methodology',
                    'methodology_content' => 'Tamal Chakraborty practices classical Parashara and Jaimini Vedic Astrology using Lahiri Ayanamsha (Sidereal Zodiac). Guidance is focused on clarity, timing, and conscious action.',
                    'methodology_visible' => true,
                    'expectations_title' => 'What You Can Expect',
                    'expectations_items' => [
                        ['title' => '100% Confidentiality', 'description' => 'Private, secure consultation.'],
                        ['title' => 'Clear Answers', 'description' => 'Direct response to your questions.'],
                        ['title' => 'Practical Remedies', 'description' => 'Authentic, achievable remedial guidance.']
                    ],
                    'expectations_visible' => true,
                    'faqs_eyebrow' => 'FREQUENTLY ASKED QUESTIONS',
                    'faqs_title' => 'Service FAQ',
                    'faqs_items' => [
                        ['question' => 'How long is the consultation?', 'answer' => 'Standard consultation duration is 45 minutes.'],
                        ['question' => 'Can I ask specific questions?', 'answer' => 'Yes, you can discuss your specific queries during the 1-on-1 session.']
                    ],
                    'faqs_visible' => true,
                    'cta_eyebrow' => '• SCHEDULE YOUR SESSION •',
                    'cta_title' => 'Ready for ' . $serv->title . '?',
                    'cta_description' => 'Book a private consultation with Tamal Chakraborty to receive personalized astrological guidance.',
                    'cta_button_text' => 'BOOK CONSULTATION',
                    'cta_url' => route('consultation.book', [], false),
                    'cta_visible' => true,
                    'seo_title' => $serv->title . ' — Tamal Chakraborty',
                    'seo_meta_description' => $serv->short_description,
                ]);
            }
        }
    }
}
