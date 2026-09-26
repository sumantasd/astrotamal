# Tamal Chakraborty — Premium Vedic Astrology & Spiritual Guidance Website

A custom, production-quality premium astrology website designed and built for **Tamal Chakraborty (Astrologer | Vedic Guidance)** using **Laravel 12, PHP 8.3+, Tailwind CSS, Alpine.js, Vite, and Filament Admin Panel**.

---

## 🌟 Brand & Visual Identity

- **Brand Name:** Tamal Chakraborty
- **Tagline:** Astrologer | Vedic Guidance
- **Design Aesthetic:** Luxury + Spiritual + Modern Editorial + Premium Indian Astrology
- **Color Palette:**
  - **Dark Midnight Navy:** `#0B0E14`, `#0F1420`, `#141A29`
  - **Metallic Gold Accents:** `#D4AF37`, `#C5A059`, `#F3E5AB`
  - **Light Warm Ivory / Soft Cream:** `#FDFBF7`, `#F9F6F0`, `#F5F0E6`
  - **Typography:** *Cormorant Garamond / Cinzel* (Serif Headings) & *Plus Jakarta Sans* (Body & UI)

---

## 🚀 Key Features & Included Pages

### 1. Homepage (`/`) — 14 Long-Form Landing Sections
1. **Sticky Header:** Translucent dark header with logo, navigation links, and gold CTA `[ Book Consultation → ]`.
2. **Cinematic Hero:** High-res custom portrait of Tamal Chakraborty, celestial zodiac halo animation, divine blueprint headline, intro video badge, and floating quote overlay.
3. **Trust & Statistics Strip:** Authentic Knowledge, Personalized Guidance, Confidential & Secure, Practical Remedies, and Global Consultation pills with line icons.
4. **Astrology Services Grid:** 6 dark navy cards with gold iconography, price indicators, short descriptions, and hover lift effects.
5. **About Editorial Section:** Two-column layout with Tamal Chakraborty's study portrait, experience badge (`15+ Years`), classical Jyotish bio, and expertise checklist.
6. **Metallic Experience Strip:** Key metrics (15+ Years, 1000+ Clients, 5000+ Consultations, 95% Positive Feedback, 10+ Countries).
7. **Explore Zodiac Section:** 12 interactive circular zodiac sign cards linking to individual horoscope forecasts.
8. **Consultation Process (How It Works):** 4 step-by-step cards + prominent dark CTA card with gold glow.
9. **Client Testimonials:** Reviews with client avatar images, 5 gold stars, city location tags, and service tags.
10. **Astrology Blog / Insights:** Latest articles covering Planets, Relationships, and Vastu.
11. **Large CTA Banner:** Meditating silhouette graphic, cosmic galaxy background, quote, and consultation booking callout.
12. **Expandable FAQ Accordion:** Common questions regarding consultation, birth details, payments, and confidentiality.
13. **Contact & Location:** Office info, operating hours, inquiry form, and interactive location map card.
14. **Footer:** Quick links, services navigation, legal policies, copyright notice, and social media links.

### 2. Service Pages (`/services` & `/services/{slug}`)
- Complete catalog of all 6 services with full descriptions, pricing, consultation duration, key benefits, and booking sidebar.

### 3. Zodiac Horoscope Hub (`/horoscope` & `/horoscope/{slug}`)
- Interactive sign hub with tabs for Daily, Weekly, and Monthly predictions for all 12 zodiac signs.

### 4. Janam Kundli Calculator (`/kundli`)
- Interactive Vedic Kundli birth chart calculation tool with DOB, time, and birth place input form + diamond North-Indian birth chart preview diagram.

### 5. Astrology Insights Blog (`/blog` & `/blog/{slug}`)
- Category filtering (Planets, Relationship, Career, Vastu, Numerology, Spirituality), author biography, and reading view.

### 6. Client Testimonials & Review Form (`/testimonials`)
- Review archive and user review submission modal/form (managed via Filament admin).

### 7. Contact Page (`/contact`)
- Office information, working hours, interactive inquiry form, and location map.

---

## ⚙️ Filament Admin Panel (`/admin`)

Manage all dynamic content from the Filament Admin Panel:

- **URL:** `http://127.0.0.1:8000/admin`
- **Email:** `admin@tamalchakraborty.com`
- **Password:** `password123`

### Managed Resources:
- **Services:** Add/edit services, prices, durations, badges, and icons.
- **Horoscopes:** Update daily, weekly, and monthly predictions for 12 zodiac signs.
- **Blog Posts:** Publish and categorize new articles.
- **Testimonials:** Approve/moderate client reviews.
- **FAQs:** Manage collapsible FAQ questions and answers.
- **Contact Inquiries:** View and process customer messages.
- **Appointments:** Manage booking requests for Phase 2 integration.

---

## 🛠️ Tech Stack & Setup

- **Framework:** Laravel 12 (PHP 8.2+)
- **Database:** SQLite (dev) / MySQL compatible
- **CSS Engine:** Tailwind CSS v4 + Custom Gold & Navy theme variables
- **JS Framework:** Alpine.js
- **Bundler:** Vite
- **Admin Panel:** Filament v3

### Local Running Instructions:
```bash
# 1. Install dependencies
composer install
npm install

# 2. Run Database Migrations & Seeders
php artisan migrate:fresh --seed

# 3. Build Assets
npm run build

# 4. Start Local Server
php artisan serve
```
