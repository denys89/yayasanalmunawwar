<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            StudentRegistrationSeeder::class,
            
            // Content and Foundation Seeders
            VisionMissionSeeder::class,
            MissionSeeder::class,
            HomepageSeeder::class,
            HistorySeeder::class,
            CoreValueSeeder::class,
            FoundationValueSeeder::class,
            
            // Organizational Structure Seeders
            OrganizationalStructureSeeder::class,
            FoundationLeadershipStructureSeeder::class,
            IslamicLeadershipValueSeeder::class,
            
            // Content Seeders
            NewsSeeder::class,
            EventSeeder::class,
            
            // Explore Seeders
            ExploreSeeder::class,
            ExploreImageSeeder::class,
            
            // Program Seeders
            ProgramSeeder::class,
            ProgramActivitySeeder::class,
            ProgramDonationSeeder::class,
            ProgramEducationSeeder::class,
            ProgramFacilitySeeder::class,
            ProgramServiceSeeder::class,
        ]);
    }
}
