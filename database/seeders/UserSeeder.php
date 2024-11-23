<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    protected $command;

    public function run(): void
    {
        // Check if users table exists to prevent errors
        if (!Schema::hasTable('users')) {
            $this->command->warn('The "users" table does not exist. Please run migrations first.');
            return;
        }

        // Prompt for the password
        $password = $this->command->ask('Enter a password for the user', 'default_password');

        // Insert the user into the database
        DB::table('users')->insert([
            'name' => $this->command->ask('Enter the user\'s name', 'John Doe'),
            'email' => $this->command->ask('Enter the user\'s email', 'john.doe@example.com'),
            'password' => Hash::make($password),
        ]);

        $this->command->info('User created successfully.');
    }
}

