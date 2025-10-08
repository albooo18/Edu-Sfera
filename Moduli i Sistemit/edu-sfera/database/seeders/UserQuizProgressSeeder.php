<?php

namespace Database\Seeders;

use App\Models\UserQuizProgress;
use Illuminate\Database\Seeder;

class UserQuizProgressSeeder extends Seeder
{
    public function run()
    {
        UserQuizProgress::factory()->count(20)->create(); // Create 20 progress entries
    }
}