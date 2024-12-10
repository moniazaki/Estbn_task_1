<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Executed', 'Completed', 'Postponed','HelpRequested'];
        foreach ($types as $type) {
            ActivityType::create(['activity_type' => $type]);
        }
    }
}
