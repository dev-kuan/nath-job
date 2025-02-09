<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Category;
use App\Models\CompanyJob;
use Illuminate\Database\Seeder;
use App\Models\JobQualification;
use App\Models\JobResponsibility;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $this->call(RolePermissionSeeder::class);
        // Seeding Categories
        Category::factory(10)->create();

        // Seeding Companies
        Company::factory(10)->create()->each(function ($company) {
            // Seeding Company Jobs
            $jobs = CompanyJob::factory(1)->create(['company_id' => $company->id]);

            foreach ($jobs as $job) {
                // Seeding Job Qualifications
                JobQualification::factory(5)->create(['company_job_id' => $job->id]);

                // Seeding Job Responsibilities
                JobResponsibility::factory(5)->create(['company_job_id' => $job->id]);
            }
        });
    }
}
