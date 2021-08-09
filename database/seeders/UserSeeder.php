<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $user = User::create([
            'email' => 'admin@' . strtolower(config('app.name')) . '.dev',
            'name' => 'admin',
            'password' => Hash::make("password"),
            'email_verified_at' => Carbon::now()
        ]);

        $user->assignRole('admin');
    }
}
