<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Usage: php artisan db:seed --class=DemoSeeder
     */
    public function run(): void
    {
        $this->command->info('🌱 Seeding CharityPress demo data...');

        $this->seedRoles();
        $this->seedUsers();
        $this->seedSettings();
        $this->seedPrograms();
        $this->seedDonations();
        $this->seedPosts();
        $this->seedNews();
        $this->seedStories();
        $this->seedPages();
        $this->seedHeroSliders();
        $this->seedContactMessages();
        $this->seedNewsletterSubscribers();

        $this->command->info('✅ Demo data seeded successfully!');
        $this->command->newLine();
        $this->command->info('─────────────────────────────────────────');
        $this->command->info('  DEMO LOGIN CREDENTIALS');
        $this->command->info('─────────────────────────────────────────');
        $this->command->info('  Admin URL  : /admin/login');
        $this->command->info('  Email      : admin@demo.com');
        $this->command->info('  Password   : admin123');
        $this->command->info('─────────────────────────────────────────');
        $this->command->warn('  ⚠️  Change credentials after first login!');
        $this->command->info('─────────────────────────────────────────');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // ROLES
    // ─────────────────────────────────────────────────────────────────────────
    private function seedRoles(): void
    {
        $this->command->line('  → Seeding roles...');

        $roles = [
            ['name' => 'super_admin', 'guard_name' => 'web', 'description' => 'Full access to everything'],
            ['name' => 'admin',       'guard_name' => 'web', 'description' => 'Manage programs, donations and content'],
            ['name' => 'editor',      'guard_name' => 'web', 'description' => 'Manage content only'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                array_merge($role, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // USERS
    // ─────────────────────────────────────────────────────────────────────────
    private function seedUsers(): void
    {
        $this->command->line('  → Seeding users...');

        $users = [
            [
                'f_name'     => 'Super',
                'l_name'     => 'Admin',
                'email'      => 'admin@demo.com',
                'password'   => Hash::make('admin123'),
                'user_type'  => 'admin',
                'is_active'  => true,
                'email_verified_at' => now(),
            ],
            [
                'f_name'     => 'John',
                'l_name'     => 'Admin',
                'email'      => 'john@demo.com',
                'password'   => Hash::make('demo1234'),
                'user_type'  => 'admin',
                'is_active'  => true,
                'email_verified_at' => now(),
            ],
            [
                'f_name'     => 'Sarah',
                'l_name'     => 'Editor',
                'email'      => 'sarah@demo.com',
                'password'   => Hash::make('demo1234'),
                'user_type'  => 'admin',
                'is_active'  => true,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                array_merge($user, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // SETTINGS
    // ─────────────────────────────────────────────────────────────────────────
    private function seedSettings(): void
    {
        $this->command->line('  → Seeding site settings...');

        $settings = [
            ['key' => 'site_name',          'value' => 'CharityPress', 'name' => 'site_name'],
            ['key' => 'site_tagline',        'value' => 'Together We Make a Difference', 'name' => 'site_tagline'],
            ['key' => 'site_email',          'value' => 'info@charitypress.com', 'name' => 'site_email'],
            ['key' => 'site_phone',          'value' => '+1 (800) 123-4567', 'name' => 'site_phone'],
            ['key' => 'site_address',        'value' => '123 Charity Lane, New York, NY 10001', 'name' => 'site_address'],
            ['key' => 'facebook_url',        'value' => 'https://facebook.com', 'name' => 'facebook_url'],
            ['key' => 'twitter_url',         'value' => 'https://twitter.com', 'name' => 'twitter_url'],
            ['key' => 'instagram_url',       'value' => 'https://instagram.com', 'name' => 'instagram_url'],
            ['key' => 'linkedin_url',        'value' => 'https://linkedin.com', 'name' => 'linkedin_url'],
            ['key' => 'donation_currency',   'value' => 'USD', 'name' => 'donation_currency'],
            ['key' => 'donation_min_amount', 'value' => '5', 'name' => 'donation_min_amount'],
            ['key' => 'meta_description',    'value' => 'CharityPress is a complete nonprofit and charity management system built with Laravel and Livewire.'],
        ];

        foreach ($settings as $setting) {
            DB::table('system_settings')->updateOrInsert(
                ['key' => $setting['key'], 'name' => $setting['key']],
                array_merge($setting, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PROGRAMS
    // ─────────────────────────────────────────────────────────────────────────
    private function seedPrograms(): void
    {
        $this->command->line('  → Seeding programs...');

        // Categories
        $categories = [
            ['name' => 'Education',    'slug' => 'education',    'description' => 'Educational programs for underprivileged children'],
            ['name' => 'Healthcare',   'slug' => 'healthcare',   'description' => 'Medical aid and health awareness programs'],
            ['name' => 'Food Relief',  'slug' => 'food-relief',  'description' => 'Feeding programs for families in need'],
            ['name' => 'Environment',  'slug' => 'environment',  'description' => 'Environmental conservation and awareness'],
            ['name' => 'Women Empowerment', 'slug' => 'women-empowerment', 'description' => 'Supporting women in developing communities'],
        ];

        foreach ($categories as $cat) {
            DB::table('program_categories')->updateOrInsert(
                ['slug' => $cat['slug']],
                array_merge($cat, ['created_at' => now(), 'updated_at' => now()])
            );
        }

        $catIds = DB::table('program_categories')->pluck('id', 'slug');

        // Programs
        $programs = [
            [
                'title'        => 'Education for Every Child',
                'slug'         => 'education-for-every-child',
                'short_description' => 'Help us provide quality education to children in underserved communities.',
                'description'  => '<p>Education is the most powerful tool we can give to a child. This program focuses on building schools, providing school supplies, and offering scholarships to children who cannot afford education. Your donation directly funds classrooms, teachers, and learning materials for hundreds of children.</p><p>Since our launch, we have helped over 2,000 children gain access to quality education. Join us in expanding this impact.</p>',
                'goal_amount'  => 50000.00,
                'current_amount' => 32500.00,
                'category_id'  => $catIds['education'],
                'is_featured'  => 1,
                'is_active'    => 1,
            ],
            [
                'title'        => 'Clean Water Initiative',
                'slug'         => 'clean-water-initiative',
                'short_description' => 'Bringing clean drinking water to villages without access to safe water.',
                'description'  => '<p>Millions of people around the world lack access to clean drinking water. This program funds the construction of water wells, filtration systems, and sanitation facilities in rural communities. Safe water reduces disease and improves quality of life dramatically.</p>',
                'goal_amount'  => 30000.00,
                'current_amount' => 18750.00,
                'category_id'  => $catIds['healthcare'],
                'is_featured'  => 1,
                'is_active'    => 1,
            ],
            [
                'title'        => 'Feed a Family Program',
                'slug'         => 'feed-a-family-program',
                'short_description' => 'Providing nutritious meals to families facing food insecurity.',
                'description'  => '<p>Food insecurity affects millions of families. Our Feed a Family program distributes monthly food packages containing staple goods to families in need. Each $25 donation feeds a family of four for an entire week.</p>',
                'goal_amount'  => 20000.00,
                'current_amount' => 14200.00,
                'category_id'  => $catIds['food-relief'],
                'is_featured'  => 0,
                'is_active'    => 1,
            ],
            [
                'title'        => 'Women Entrepreneurship Fund',
                'slug'         => 'women-entrepreneurship-fund',
                'short_description' => 'Empowering women with microloans and business training.',
                'description'  => '<p>Economic empowerment changes everything for women and their families. This fund provides microloans, business training, and mentorship to women entrepreneurs in developing regions. One loan can transform an entire family\'s future.</p>',
                'goal_amount'  => 40000.00,
                'current_amount' => 22000.00,
                'category_id'  => $catIds['women-empowerment'],
                'is_featured'  => 1,
                'is_active'    => 1,
            ],
            [
                'title'        => 'Tree Planting & Reforestation',
                'slug'         => 'tree-planting-reforestation',
                'short_description' => 'Restoring forests and fighting climate change one tree at a time.',
                'description'  => '<p>Deforestation is one of the biggest threats to our planet. Our reforestation program plants native trees in deforested areas, restoring ecosystems and sequestering carbon. Each $10 donation plants 5 trees.</p>',
                'goal_amount'  => 15000.00,
                'current_amount' => 9800.00,
                'category_id'  => $catIds['environment'],
                'is_featured'  => 0,
                'is_active'    => 1,
            ],
            [
                'title'        => 'Mobile Health Clinics',
                'slug'         => 'mobile-health-clinics',
                'short_description' => 'Bringing essential healthcare to remote communities.',
                'description'  => '<p>Remote communities often have no access to medical care. Our mobile health clinics travel to these areas to provide checkups, vaccinations, and basic treatments. Help us keep these life-saving clinics running.</p>',
                'goal_amount'  => 60000.00,
                'current_amount' => 41000.00,
                'category_id'  => $catIds['healthcare'],
                'is_featured'  => 0,
                'is_active'    => 1,
            ],
        ];

        foreach ($programs as $program) {
            DB::table('programs')->updateOrInsert(
                ['slug' => $program['slug']],
                array_merge($program, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // DONATIONS
    // ─────────────────────────────────────────────────────────────────────────
    private function seedDonations(): void
    {
        $this->command->line('  → Seeding donations...');

        $programs   = DB::table('programs')->pluck('id')->toArray();
        $firstNames = ['Emma','Liam','Olivia','Noah','Ava','James','Isabella','Oliver','Sophia','William','Mia','Benjamin','Charlotte','Elijah','Amelia'];
        $lastNames  = ['Smith','Johnson','Williams','Brown','Jones','Garcia','Miller','Davis','Wilson','Anderson','Taylor','Thomas','Moore','Jackson','Martin'];
        $types      = ['one_time', 'one_time', 'one_time', 'recurring'];
        $amounts    = [10, 25, 50, 100, 250, 500];

        for ($i = 1; $i <= 30; $i++) {
            $fname = $firstNames[array_rand($firstNames)];
            $lname = $lastNames[array_rand($lastNames)];
            $type  = $types[array_rand($types)];

            DB::table('donations')->insert([
                'donation_number' => 'DON-' . strtoupper(Str::random(8)),
                'donor_name'      => "$fname $lname",
                'donor_email'     => strtolower($fname) . '.' . strtolower($lname) . $i . '@example.com',
                'amount'          => $amounts[array_rand($amounts)],
                'currency'        => 'USD',
                'type'            => $type,
                'status'          => 'completed',
                'program_id'      => !empty($programs) ? $programs[array_rand($programs)] : null,
                'stripe_payment_id' => 'pi_demo_' . Str::random(24),
                'message'         => $i % 3 === 0 ? 'Keep up the great work! Your mission is inspiring.' : null,
                'created_at'      => Carbon::now()->subDays(rand(1, 180)),
                'updated_at'      => now(),
            ]);
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // BLOG POSTS
    // ─────────────────────────────────────────────────────────────────────────
    private function seedPosts(): void
    {
        $this->command->line('  → Seeding blog posts...');

        $adminId = DB::table('users')->where('email', 'admin@demo.com')->value('id');

        $posts = [
            [
                'title'           => '5 Ways Your Donation Makes a Real Difference',
                'slug'            => '5-ways-your-donation-makes-a-real-difference',
                'excerpt'         => 'Every dollar you donate goes directly to changing lives. Here is how your generosity is put to work.',
                'content'         => '<p>When you donate to a charity, you might wonder exactly where your money goes. At CharityPress, we believe in complete transparency. Here are five tangible ways your donation creates real, lasting change in the world.</p><h3>1. Direct Aid to Families</h3><p>A significant portion of every donation goes directly to families in need through our various programs. Whether it is food parcels, medical supplies, or school materials, your money reaches real people.</p><h3>2. Building Infrastructure</h3><p>Donations fund long-term infrastructure like wells, schools, and clinics that serve communities for decades.</p><h3>3. Training and Education</h3><p>We invest in training local community workers who continue serving their communities long after our teams leave.</p>',
                'meta_description'=> 'Discover 5 impactful ways your charity donation changes lives and creates lasting change in communities.',
                'is_published'    => 1,
                'user_id'         => $adminId,
                'published_at'    => Carbon::now()->subDays(5),
            ],
            [
                'title'           => 'How We Reached 10,000 Families This Year',
                'slug'            => 'how-we-reached-10000-families-this-year',
                'excerpt'         => 'A milestone year for our organization — here is the story of how your support made it possible.',
                'content'         => '<p>This year has been extraordinary. Thanks to the incredible generosity of our donors and the tireless dedication of our team, we reached a milestone we have been working toward for years: supporting 10,000 families.</p><p>This achievement was made possible by people like you — ordinary individuals who chose to give, to care, and to take action.</p>',
                'meta_description'=> 'Read about how CharityPress reached 10,000 families and what this milestone means for our future.',
                'is_published'    => 1,
                'user_id'         => $adminId,
                'published_at'    => Carbon::now()->subDays(12),
            ],
            [
                'title'           => 'The Importance of Clean Water in Rural Communities',
                'slug'            => 'importance-of-clean-water-in-rural-communities',
                'excerpt'         => 'Access to clean water transforms entire communities. Here is why this cause deserves our attention.',
                'content'         => '<p>Clean water is not a luxury — it is a human right. Yet millions of people around the world lack access to safe drinking water. This affects not just health but education, economic opportunity, and gender equality.</p><p>When a village gains access to a clean water source, children — especially girls — spend less time walking to collect water and more time in school. Disease rates drop. Agricultural productivity rises.</p>',
                'meta_description'=> 'Understand why clean water access is transformative for rural communities and how you can help.',
                'is_published'    => 1,
                'user_id'         => $adminId,
                'published_at'    => Carbon::now()->subDays(20),
            ],
        ];

        foreach ($posts as $post) {
            DB::table('posts')->updateOrInsert(
                ['slug' => $post['slug']],
                array_merge($post, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // NEWS
    // ─────────────────────────────────────────────────────────────────────────
    private function seedNews(): void
    {
        $this->command->line('  → Seeding news...');

        $adminId = DB::table('users')->where('email', 'admin@demo.com')->value('id');

        $news = [
            [
                'title'        => 'CharityPress Launches New Food Relief Program in Three Cities',
                'slug'         => 'charitypress-launches-new-food-relief-program',
                'excerpt'      => 'We are excited to announce the expansion of our food relief program to three new cities.',
                'content'      => '<p>We are thrilled to announce the expansion of our Feed a Family program to three new cities. Starting this month, we will be distributing weekly food packages to over 500 additional families in need. This expansion was made possible entirely by donor contributions.</p>',
                'is_published' => 1,
                'user_id'      => $adminId,
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'title'        => 'Annual Charity Gala Raises $150,000 for Education Programs',
                'slug'         => 'annual-charity-gala-raises-150000',
                'excerpt'      => 'Our annual gala was a tremendous success, raising record funds for children\'s education.',
                'content'      => '<p>Last weekend\'s Annual Charity Gala was the most successful in our organization\'s history. With over 300 attendees and generous auction contributions, we raised $150,000 in a single evening. All funds will go directly to our education programs.</p>',
                'is_published' => 1,
                'user_id'      => $adminId,
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title'        => 'Partnership Announcement: Teaming Up with Global Health Foundation',
                'slug'         => 'partnership-with-global-health-foundation',
                'excerpt'      => 'We are proud to announce a new strategic partnership to expand our healthcare reach.',
                'content'      => '<p>We are proud to announce a new strategic partnership with the Global Health Foundation. This collaboration will allow us to expand our mobile health clinic program to 10 additional rural communities over the next 12 months.</p>',
                'is_published' => 1,
                'user_id'      => $adminId,
                'published_at' => Carbon::now()->subDays(25),
            ],
        ];

        foreach ($news as $item) {
            DB::table('news')->updateOrInsert(
                ['slug' => $item['slug']],
                array_merge($item, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // STORIES
    // ─────────────────────────────────────────────────────────────────────────
    private function seedStories(): void
    {
        $this->command->line('  → Seeding stories...');

        $adminId = DB::table('users')->where('email', 'admin@demo.com')->value('id');

        $stories = [
            [
                'title'        => 'Amina\'s Story: From Hunger to Hope',
                'slug'         => 'aminas-story-from-hunger-to-hope',
                'excerpt'      => 'Amina was seven years old and had not eaten in two days when our team first met her.',
                'content'      => '<p>Amina was seven years old and had not eaten in two days when our team first met her. Her mother had lost her job and the family was struggling to survive. Through our Feed a Family program, Amina\'s family now receives weekly food packages. She is healthy, back in school, and dreams of becoming a doctor.</p><p>"Before the food packages came, I could not concentrate in school," Amina says. "Now I eat breakfast every morning and I love to learn."</p>',
                'is_published' => 1,
                'user_id'      => $adminId,
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'title'        => 'Mohammed Builds His Dream School',
                'slug'         => 'mohammed-builds-his-dream-school',
                'excerpt'      => 'A village teacher who refused to give up on his students despite having no classroom.',
                'content'      => '<p>Mohammed had been teaching children under a tree for three years. He had no classroom, no supplies, and no salary — just an unshakeable belief that education could change his community. When our team discovered his outdoor school, we knew we had to help. Thanks to donor funding, Mohammed\'s village now has a proper school with four classrooms.</p>',
                'is_published' => 1,
                'user_id'      => $adminId,
                'published_at' => Carbon::now()->subDays(14),
            ],
            [
                'title'        => 'Maria\'s Microenterprise: One Loan, One Life Changed',
                'slug'         => 'marias-microenterprise-one-loan-one-life-changed',
                'excerpt'      => 'A $200 microloan gave Maria the start she needed to build a business that now employs three people.',
                'content'      => '<p>Maria is a single mother of four from a small rural town. When our Women Entrepreneurship Fund offered her a $200 microloan, she used it to buy sewing materials and started making and selling clothing. Today, two years later, her small business employs three other women from her community and supports her entire family.</p>',
                'is_published' => 1,
                'user_id'      => $adminId,
                'published_at' => Carbon::now()->subDays(21),
            ],
        ];

        foreach ($stories as $story) {
            DB::table('stories')->updateOrInsert(
                ['slug' => $story['slug']],
                array_merge($story, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PAGES
    // ─────────────────────────────────────────────────────────────────────────
    private function seedPages(): void
    {
        $this->command->line('  → Seeding pages...');

        $pages = [
            [
                'title'   => 'Privacy Policy',
                'slug'    => 'privacy-policy',
                'content' => '<h2>Privacy Policy</h2><p>This Privacy Policy describes how CharityPress collects, uses, and shares information about you when you use our services. By using our website, you agree to the collection and use of information in accordance with this policy.</p><h3>Information We Collect</h3><p>We collect information you provide directly to us, such as when you make a donation, create an account, or contact us. This may include your name, email address, phone number, and payment information.</p><h3>How We Use Your Information</h3><p>We use the information we collect to process donations, send receipts, communicate with you about our programs, and improve our services.</p><h3>Contact Us</h3><p>If you have questions about this privacy policy, please contact us at privacy@charitypress.com.</p>',
                'is_published' => 1,
            ],
            [
                'title'   => 'Terms of Service',
                'slug'    => 'terms-of-service',
                'content' => '<h2>Terms of Service</h2><p>By accessing and using CharityPress, you agree to be bound by these Terms of Service. Please read them carefully.</p><h3>Use of Service</h3><p>You may use our service only for lawful purposes and in accordance with these terms. You agree not to use the service in any way that violates applicable laws or regulations.</p><h3>Donations</h3><p>All donations are final and non-refundable unless required by law. We use Stripe for secure payment processing.</p><h3>Disclaimer</h3><p>Our service is provided on an "as is" and "as available" basis. We make no warranties, expressed or implied, regarding the service.</p>',
                'is_published' => 1,
            ],
        ];

        foreach ($pages as $page) {
            DB::table('pages')->updateOrInsert(
                ['slug' => $page['slug']],
                array_merge($page, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // HERO SLIDERS
    // ─────────────────────────────────────────────────────────────────────────
    private function seedHeroSliders(): void
    {
        $this->command->line('  → Seeding hero sliders...');

        $sliders = [
            [
                'title'       => 'Together We Can Change Lives',
                'subtitle'    => 'Your donation helps us provide food, education, and healthcare to families in need.',
                'button_text' => 'Donate Now',
                'button_url'  => '/donate',
                'order'       => 1,
                'is_active'   => 1,
            ],
            [
                'title'       => 'Education Is the Key to a Better Future',
                'subtitle'    => 'Help us build schools and provide scholarships to children who dream of learning.',
                'button_text' => 'Our Programs',
                'button_url'  => '/programs',
                'order'       => 2,
                'is_active'   => 1,
            ],
            [
                'title'       => 'Every Drop of Clean Water Saves a Life',
                'subtitle'    => 'Join our mission to bring clean, safe drinking water to communities that need it most.',
                'button_text' => 'Learn More',
                'button_url'  => '/programs/clean-water-initiative',
                'order'       => 3,
                'is_active'   => 1,
            ],
        ];

        foreach ($sliders as $slider) {
            DB::table('hero_sliders')->updateOrInsert(
                ['title' => $slider['title']],
                array_merge($slider, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // CONTACT MESSAGES
    // ─────────────────────────────────────────────────────────────────────────
    private function seedContactMessages(): void
    {
        $this->command->line('  → Seeding contact messages...');

        $messages = [
            ['name' => 'David Thompson',   'email' => 'david@example.com',   'subject' => 'Partnership Inquiry',      'message' => 'Hello, I represent a corporate foundation and we are interested in partnering with your organization for our CSR initiatives. Could we schedule a call?', 'status' => 'unread'],
            ['name' => 'Fatima Al-Rashid', 'email' => 'fatima@example.com',  'subject' => 'Volunteer Opportunity',    'message' => 'I am a nurse and I would love to volunteer with your mobile health clinics. How can I apply?', 'status' => 'read'],
            ['name' => 'Carlos Rodriguez', 'email' => 'carlos@example.com',  'subject' => 'Donation Receipt Question','message' => 'I made a donation last week but have not received a receipt yet. Could you please resend it to me?', 'status' => 'replied'],
            ['name' => 'Jennifer Walsh',   'email' => 'jennifer@example.com', 'subject' => 'Monthly Giving Program',  'message' => 'I would like to set up a monthly recurring donation. Can you walk me through the process?', 'status' => 'unread'],
            ['name' => 'Ahmed Hassan',     'email' => 'ahmed@example.com',   'subject' => 'School Building Project',  'message' => 'We have land available in our village for a school. Is your organization able to help fund the construction?', 'status' => 'unread'],
        ];

        foreach ($messages as $msg) {
            DB::table('contact_messages')->insert(
                array_merge($msg, ['created_at' => Carbon::now()->subDays(rand(1, 30)), 'updated_at' => now()])
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // NEWSLETTER SUBSCRIBERS
    // ─────────────────────────────────────────────────────────────────────────
    private function seedNewsletterSubscribers(): void
    {
        $this->command->line('  → Seeding newsletter subscribers...');

        $subscribers = [
            'emma.wilson@example.com',
            'liam.johnson@example.com',
            'olivia.smith@example.com',
            'noah.brown@example.com',
            'ava.jones@example.com',
            'james.garcia@example.com',
            'isabella.miller@example.com',
            'oliver.davis@example.com',
            'sophia.wilson@example.com',
            'william.anderson@example.com',
            'mia.taylor@example.com',
            'benjamin.thomas@example.com',
            'charlotte.moore@example.com',
            'elijah.jackson@example.com',
            'amelia.martin@example.com',
        ];

        foreach ($subscribers as $email) {
            DB::table('newsletter_subscribers')->updateOrInsert(
                ['email' => $email],
                [
                    'email'       => $email,
                    'is_active'   => 1,
                    'created_at'  => Carbon::now()->subDays(rand(1, 120)),
                    'updated_at'  => now(),
                ]
            );
        }
    }
}
