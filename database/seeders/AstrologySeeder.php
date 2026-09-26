<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Horoscope;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AstrologySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin User for Filament
        User::updateOrCreate(
            ['email' => 'admin@tamalchakraborty.com'],
            [
                'name' => 'Tamal Chakraborty',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Seed 6 Core Services for Tamal Chakraborty (1600x900 16:9 Editorial Images)
        Service::query()->delete();

        $services = [
            [
                'title' => 'Birth Chart Analysis',
                'slug' => 'birth-chart',
                'short_description' => 'A detailed study of your birth chart to understand important aspects of your life and gain personalised astrological guidance.',
                'full_description' => 'A comprehensive examination of your Janam Kundli analyzing planetary positions, Lagna, Chandra Rashi, Mahadasha cycles, core strengths, and time-tested Vedic guidance for key life decisions.',
                'icon' => 'sun',
                'image' => 'https://images.unsplash.com/photo-1532012197267-da84d127e765?q=80&w=1200&h=900&auto=format&fit=crop',
                'badge' => 'Birth Chart',
                'price' => 'Consultation',
                'duration' => '45 Mins',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Transit & Timing Analysis',
                'slug' => 'transit-timing',
                'short_description' => 'Understanding planetary transits and changing periods to explore how different phases of time may influence important areas of your life.',
                'full_description' => 'Explore the dynamics of planetary transits (Gochar) and timing of events. Gain clarity on favorable and challenging phases of time to make well-timed personal and professional decisions.',
                'icon' => 'clock',
                'image' => 'https://images.unsplash.com/photo-1506703719100-a0f3a48c0f86?q=80&w=1200&h=900&auto=format&fit=crop',
                'badge' => 'Transit & Timing',
                'price' => 'Consultation',
                'duration' => '45 Mins',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Career & Job Guidance',
                'slug' => 'career-guidance',
                'short_description' => 'Astrological guidance for career, employment and professional decisions based on your birth chart and planetary timing.',
                'full_description' => 'In-depth assessment of your 10th house, Saturn and Mercury placements for career direction, job changes, promotions, work transitions, and professional timing.',
                'icon' => 'briefcase',
                'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1200&h=900&auto=format&fit=crop',
                'badge' => 'Career Guidance',
                'price' => 'Consultation',
                'duration' => '45 Mins',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Business Guidance',
                'slug' => 'business-guidance',
                'short_description' => 'Explore business-related decisions, opportunities and timing through a birth-chart and astrology-based perspective.',
                'full_description' => 'Astrological evaluation for business ventures, partnership compatibility, expansion timing, and navigating strategic commercial phases based on planetary influences.',
                'icon' => 'trending-up',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200&h=900&auto=format&fit=crop',
                'badge' => 'Business Guidance',
                'price' => 'Consultation',
                'duration' => '45 Mins',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Life Direction Guidance',
                'slug' => 'life-direction',
                'short_description' => 'Gain clarity on important phases of life and explore possible directions through the combined understanding of your birth chart and time.',
                'full_description' => 'Holistic consultation focusing on key life phases, decision-making clarity, personal growth, and understanding the interplay between your birth chart and time.',
                'icon' => 'compass',
                'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200&h=900&auto=format&fit=crop',
                'badge' => 'Life Direction',
                'price' => 'Consultation',
                'duration' => '45 Mins',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Learn Astrology',
                'slug' => 'astrology-learning',
                'short_description' => 'Explore the logic and fundamentals of astrology, including Rashi, Lagna, Chandra Rashi, Rashichakra, planetary positions and other important concepts.',
                'full_description' => 'Structured educational guidance into classical Vedic astrology principles. Learn about Rashi, Lagna, Chandra Rashi, Rashichakra, Bhavas, planetary positions, and astronomical logic.',
                'icon' => 'book-open',
                'image' => 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?q=80&w=1200&h=900&auto=format&fit=crop',
                'badge' => 'Astrology Learning',
                'price' => 'Learning Program',
                'duration' => 'Sessions',
                'is_featured' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }

        // 3. Seed 12 Zodiac Horoscopes
        $zodiacs = [
            [
                'zodiac_sign' => 'Aries',
                'slug' => 'aries',
                'symbol' => '♈',
                'element' => 'Fire',
                'date_range' => 'MAR 21 – APR 19',
                'ruling_planet' => 'Mars',
                'lucky_number' => '9, 18',
                'lucky_color' => 'Crimson Red',
                'overview' => 'Aries individuals possess high energy, leadership attributes, and pioneer spirit.',
                'daily_prediction' => 'Today brings new initiative opportunities at work. High focus on career goals.',
                'weekly_prediction' => 'Financial planning needs extra attention mid-week. Relationship gains expected.',
                'monthly_prediction' => 'Mars position favors professional advancements and major decision-making.',
            ],
            [
                'zodiac_sign' => 'Taurus',
                'slug' => 'taurus',
                'symbol' => '♉',
                'element' => 'Earth',
                'date_range' => 'APR 20 – MAY 20',
                'ruling_planet' => 'Venus',
                'lucky_number' => '6, 15',
                'lucky_color' => 'Emerald Green',
                'overview' => 'Taurus represents stability, determination, appreciation for luxury, and artistic flair.',
                'daily_prediction' => 'Venus confers harmony in personal connections and creative insights.',
                'weekly_prediction' => 'Financial investments yield positive returns. Good time for family gatherings.',
                'monthly_prediction' => 'Career stability continues; focus on long-term property or asset acquisitions.',
            ],
            [
                'zodiac_sign' => 'Gemini',
                'slug' => 'gemini',
                'symbol' => '♊',
                'element' => 'Air',
                'date_range' => 'MAY 21 – JUN 20',
                'ruling_planet' => 'Mercury',
                'lucky_number' => '5, 14',
                'lucky_color' => 'Warm Yellow',
                'overview' => 'Gemini individuals excel in communication, adaptability, intellect, and networking.',
                'daily_prediction' => 'Mercury boosts your articulation. Excellent day for negotiations and emails.',
                'weekly_prediction' => 'Short travel or new learning opportunities enhance your professional profile.',
                'monthly_prediction' => 'Networking opens doors to international or regional project partnerships.',
            ],
            [
                'zodiac_sign' => 'Cancer',
                'slug' => 'cancer',
                'symbol' => '♋',
                'element' => 'Water',
                'date_range' => 'JUN 21 – JUL 22',
                'ruling_planet' => 'Moon',
                'lucky_number' => '2, 7',
                'lucky_color' => 'Pearl White',
                'overview' => 'Cancerians are intuitive, nurturing, deeply devoted to family, and emotionally profound.',
                'daily_prediction' => 'Moon transit brings deep peace and clarity around home environment.',
                'weekly_prediction' => 'Nurture key relationships. Business ideas receive family blessing.',
                'monthly_prediction' => 'Emotional wellbeing and domestic prosperity peak towards the month end.',
            ],
            [
                'zodiac_sign' => 'Leo',
                'slug' => 'leo',
                'symbol' => '♌',
                'element' => 'Fire',
                'date_range' => 'JUL 23 – AUG 22',
                'ruling_planet' => 'Sun',
                'lucky_number' => '1, 10',
                'lucky_color' => 'Royal Gold',
                'overview' => 'Leos are charismatic, confident, generous leaders with natural royal presence.',
                'daily_prediction' => 'Sun radiance places you in the spotlight. Management acknowledges your effort.',
                'weekly_prediction' => 'Leadership roles beckon. Express your vision with clarity and authority.',
                'monthly_prediction' => 'Major career breakthrough aligns with Sun transit in favorable houses.',
            ],
            [
                'zodiac_sign' => 'Virgo',
                'slug' => 'virgo',
                'symbol' => '♍',
                'element' => 'Earth',
                'date_range' => 'AUG 23 – SEP 22',
                'ruling_planet' => 'Mercury',
                'lucky_number' => '5, 23',
                'lucky_color' => 'Champagne Gold',
                'overview' => 'Virgos excel in analytical precision, practical problem solving, and dedicated service.',
                'daily_prediction' => 'Meticulous planning solves a persistent workflow bottleneck.',
                'weekly_prediction' => 'Health and wellness routine brings renewed vitality. Budgeting goes smoothly.',
                'monthly_prediction' => 'Skill enhancement leads to salary increment or lucrative consultancy offers.',
            ],
            [
                'zodiac_sign' => 'Libra',
                'slug' => 'libra',
                'symbol' => '♎',
                'element' => 'Air',
                'date_range' => 'SEP 23 – OCT 22',
                'ruling_planet' => 'Venus',
                'lucky_number' => '6, 15',
                'lucky_color' => 'Rose Pink & Gold',
                'overview' => 'Libras seek balance, diplomatic solutions, aesthetic beauty, and partnership.',
                'daily_prediction' => 'Harmony returns to personal relationships. Ideal day for signing contracts.',
                'weekly_prediction' => 'Collaborative endeavors flourish. Social invitations bring joyful connections.',
                'monthly_prediction' => 'Relationship milestones and aesthetic home upgrades take center stage.',
            ],
            [
                'zodiac_sign' => 'Scorpio',
                'slug' => 'scorpio',
                'symbol' => '♏',
                'element' => 'Water',
                'date_range' => 'OCT 23 – NOV 21',
                'ruling_planet' => 'Mars',
                'lucky_number' => '8, 17',
                'lucky_color' => 'Deep Navy & Garnet',
                'overview' => 'Scorpios possess profound intuition, intensity, resilience, and spiritual depth.',
                'daily_prediction' => 'Deep research yields valuable breakthroughs. Follow your strong gut instinct.',
                'weekly_prediction' => 'Financial investments or inheritance queries move forward positively.',
                'monthly_prediction' => 'Transformative growth in personal mastery and spiritual understanding.',
            ],
            [
                'zodiac_sign' => 'Sagittarius',
                'slug' => 'sagittarius',
                'slug' => 'sagittarius',
                'symbol' => '♐',
                'element' => 'Fire',
                'date_range' => 'NOV 22 – DEC 21',
                'ruling_planet' => 'Jupiter',
                'lucky_number' => '3, 12',
                'lucky_color' => 'Yellow Sapphire',
                'overview' => 'Sagittarians are optimistic, philosophical, seekers of higher truth and expansion.',
                'daily_prediction' => 'Jupiter aspect brings optimism, wisdom, and guidance from mentors.',
                'weekly_prediction' => 'Long-distance planning or higher studies guidance becomes crystal clear.',
                'monthly_prediction' => 'Spiritual travels and expansion of business boundaries favor your chart.',
            ],
            [
                'zodiac_sign' => 'Capricorn',
                'slug' => 'capricorn',
                'symbol' => '♑',
                'element' => 'Earth',
                'date_range' => 'DEC 22 – JAN 19',
                'ruling_planet' => 'Saturn',
                'lucky_number' => '8, 26',
                'lucky_color' => 'Midnight Slate',
                'overview' => 'Capricorns exemplify discipline, perseverance, strategic ambition, and duty.',
                'daily_prediction' => 'Disciplined effort earns long-term trust from senior stakeholders.',
                'weekly_prediction' => 'Structure your goals carefully; Saturn supports steady, enduring progress.',
                'monthly_prediction' => 'Significant milestone reached in professional standing and asset building.',
            ],
            [
                'zodiac_sign' => 'Aquarius',
                'slug' => 'aquarius',
                'symbol' => '♒',
                'element' => 'Air',
                'date_range' => 'JAN 20 – FEB 18',
                'ruling_planet' => 'Saturn',
                'lucky_number' => '4, 11',
                'lucky_color' => 'Electric Navy',
                'overview' => 'Aquarians are visionary, humanitarian thinkers, innovative and original.',
                'daily_prediction' => 'Innovative ideas gain enthusiastic support from your peer network.',
                'weekly_prediction' => 'Group activities and community welfare bring immense satisfaction.',
                'monthly_prediction' => 'Tech innovation or non-profit venture receives favorable planetary wind.',
            ],
            [
                'zodiac_sign' => 'Pisces',
                'slug' => 'pisces',
                'symbol' => '♓',
                'element' => 'Water',
                'date_range' => 'FEB 19 – MAR 20',
                'ruling_planet' => 'Jupiter',
                'lucky_number' => '3, 7',
                'lucky_color' => 'Sea Green & Gold',
                'overview' => 'Piscians are compassionate, highly creative, spiritually attuned, and empathetic.',
                'daily_prediction' => 'Spiritual practices deepen peace of mind. Creative inspiration is high.',
                'weekly_prediction' => 'Intuitive insights help solve complex interpersonal dynamics smoothly.',
                'monthly_prediction' => 'Spiritual awakening and artistic achievements mark this transit period.',
            ],
        ];

        foreach ($zodiacs as $zodiac) {
            Horoscope::updateOrCreate(['slug' => $zodiac['slug']], $zodiac);
        }

        // 4. Seed Blog Posts
        $posts = [
            [
                'title' => 'How Planets Influence Your Career Growth',
                'slug' => 'how-planets-influence-career-growth',
                'category' => 'Planets',
                'summary' => 'Discover how the 10th house, Saturn, and Jupiter shape your professional destiny and timing for success.',
                'content' => 'In Vedic Astrology, career trajectories are governed primarily by the 10th house (Karma Bhava), its lord, and key planetary significators like Saturn (Shani), Sun (Surya), and Mercury (Budha). Understanding your Mahadasha and Antardasha cycles enables you to time job switches, promotions, and entrepreneurial ventures with precision.',
                'image' => '/images/blog_planets.jpg',
                'author_name' => 'Tamal Chakraborty',
                'read_time' => '5 min read',
                'published_at' => now()->subDays(10),
                'is_featured' => true,
            ],
            [
                'title' => 'Astrology and Marriage: Finding the Right Partner',
                'slug' => 'astrology-and-marriage-finding-right-partner',
                'category' => 'Relationship',
                'summary' => 'Understanding Guna Milan, 7th house influences, and Venus placement for lifelong relationship harmony.',
                'content' => 'Marriage is one of life’s most sacred unions. Vedic Astrology evaluates marital longevity and happiness through the 7th house, Venus (Shukra), Jupiter (Guru), and the 36 Guna Ashtakoot framework. Beyond simple scoring, assessing planetary temperaments ensures deep emotional and spiritual alignment between partners.',
                'image' => '/images/blog_relationship.jpg',
                'author_name' => 'Tamal Chakraborty',
                'read_time' => '6 min read',
                'published_at' => now()->subDays(13),
                'is_featured' => true,
            ],
            [
                'title' => 'Vastu Tips for a Prosperous Home',
                'slug' => 'vastu-tips-for-prosperous-home',
                'category' => 'Vastu',
                'summary' => 'Simple yet effective directional principles to invite peace, health, and financial abundance into your living space.',
                'content' => 'Your living space is a living energy grid. By harmonizing the North-East (Eeshanya) for mental clarity, the South-East (Agneya) for financial energy, and the South-West (Nairrutya) for stability, you can naturally cultivate peace, health, and prosperity for all family members.',
                'image' => '/images/blog_vastu.jpg',
                'author_name' => 'Tamal Chakraborty',
                'read_time' => '4 min read',
                'published_at' => now()->subDays(15),
                'is_featured' => true,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(['slug' => $post['slug']], $post);
        }

        // 5. Seed Testimonials
        Testimonial::query()->delete();
        $testimonials = [
            [
                'client_name' => 'Priya S.',
                'city' => 'Kolkata',
                'avatar' => '/images/avatar_priya.jpg',
                'rating' => 5,
                'service_tag' => 'Birth Chart & Relationship',
                'review' => 'Tamal Sir’s guidance changed my life. His predictions regarding my career transition and remedies were incredibly accurate and easy to perform.',
                'is_approved' => true,
            ],
            [
                'client_name' => 'Rahul M.',
                'city' => 'Bangalore',
                'avatar' => '/images/avatar_rahul.jpg',
                'rating' => 5,
                'service_tag' => 'Career & Financial Consultation',
                'review' => 'Very professional, practical, and knowledgeable. He gave me complete clarity on when to launch my tech business. Highly recommended!',
                'is_approved' => true,
            ],
            [
                'client_name' => 'Ananya D.',
                'city' => 'Mumbai',
                'avatar' => '/images/avatar_ananya.jpg',
                'rating' => 5,
                'service_tag' => 'Marriage & Kundli Matching',
                'review' => 'The consultation was detailed, scientific, and very reassuring. Tamal Chakraborty explains complex astrological concepts with extreme clarity.',
                'is_approved' => true,
            ],
            [
                'client_name' => 'Vikram R.',
                'city' => 'London, UK',
                'avatar' => '/images/avatar_vikram.jpg',
                'rating' => 5,
                'service_tag' => 'Vastu & Business Consultation',
                'review' => 'We consulted Tamal Sir for our new corporate office Vastu and planetary remedy. The positive shift in business momentum has been remarkable.',
                'is_approved' => true,
            ],
            [
                'client_name' => 'Sunita P.',
                'city' => 'Dubai, UAE',
                'avatar' => '/images/avatar_sunita.jpg',
                'rating' => 5,
                'service_tag' => 'Gemstone & Numerology',
                'review' => 'Authentic gemstone guidance and genuine compassion. He never promotes unnecessary rituals or expensive remedies. Truly a divine mentor.',
                'is_approved' => true,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }

        // 6. Seed FAQs
        Faq::query()->delete();
        $faqs = [
            [
                'question' => 'How can astrology help me?',
                'answer' => 'Vedic Astrology provides a clear blueprint of your life’s potential, planetary periods (Dasha), and karmic tendencies. It helps you make informed decisions regarding career, marriage, investments, and health while providing simple practical remedies to overcome obstacles.',
                'category' => 'General',
                'sort_order' => 1,
            ],
            [
                'question' => 'What details are required for consultation?',
                'answer' => 'To generate an accurate Janam Kundli, you need your Exact Date of Birth, Exact Time of Birth (with AM/PM), and City / Place of Birth. If exact time is unavailable, Prashna (Horary) astrology can also be utilized.',
                'category' => 'Consultation',
                'sort_order' => 2,
            ],
            [
                'question' => 'Is online consultation available?',
                'answer' => 'Yes, Tamal Chakraborty provides worldwide video/audio consultations via Google Meet, Zoom, and WhatsApp Call for international and national clients.',
                'category' => 'Consultation',
                'sort_order' => 3,
            ],
            [
                'question' => 'How do I make the payment?',
                'answer' => 'Payments can be securely completed online via UPI, Credit/Debit Cards, Net Banking, or International Bank Wire / PayPal for global clients.',
                'category' => 'Payment',
                'sort_order' => 4,
            ],
            [
                'question' => 'Can I reschedule my appointment?',
                'answer' => 'Yes, you may reschedule your appointment up to 24 hours prior to your scheduled slot by informing our support team via WhatsApp or Email.',
                'category' => 'Consultation',
                'sort_order' => 5,
            ],
            [
                'question' => 'Is my information kept confidential?',
                'answer' => 'Strict 100% privacy and confidentiality is guaranteed. Your birth details, personal discussion, and remedies are never shared with any third party.',
                'category' => 'Confidentiality',
                'sort_order' => 6,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
