<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EventCategorySeeder::class,
            DonationSeeder::class,
            TestimonySeeder::class,
            ContactSeeder::class,
            EventSeeder::class,
            CampaignSeeder::class,
            SponsorCategorySeeder::class,
            SponsorSeeder::class,
            SponsorSignupSeeder::class,
            NewsCategorySeeder::class,
            NewsSeeder::class,
            CommentSeeder::class,
            // Outros Seeders...
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
