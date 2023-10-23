<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Job::factory()->create([
            'name' => "admin",
            'description' => 'gerant principal',
        ]);

        Company::factory()->create([
            'name' => "Vibecro Corp",
            'phone' => '52 85 85 90',
            'email' => 'contact@vibecro-corp.com',
            'ifu' => '020211355864',
            'adresse' => 'Bohicon',
            'image' => 'logos/vibecro.png',
        ]);

        User::factory()->create([
            'company_id' => 1,
            'job_id' => 1,
            'name' => 'Test',
            'phone' => '91303142',
            'adresse' => 'ctn',
            'firstname' => 'User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);
    }
}
