<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create 10 fake employees
        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {
            $employee = Employee::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->randomNumber(8, true), 
                'profile_image' => 'profile_images/default.jpg', // Adjust as per your file storage
                'status' => $faker->randomElement(['active', 'inactive']),
                'department' => $faker->randomElement(['IT', 'HR', 'Finance', 'Marketing']),
            ]);

            // Create corresponding User
            User::create([
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'email' => $employee->email,
                'password' => bcrypt('password'),
            ]);
        }
    }
}
