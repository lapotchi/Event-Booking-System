<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(2)
            ->state(['role' => UserRoleEnum::ADMIN])
            ->create();
        User::factory()
            ->count(3)
            ->state(['role' => UserRoleEnum::ORGANIZER])
            ->create();
        User::factory()
            ->count(10)
            ->state(['role' => UserRoleEnum::CUSTOMER])
            ->create();
    }
}
