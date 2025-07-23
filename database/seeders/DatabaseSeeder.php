<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use App\Models\Loan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder yang telah dibuat
        $this->call([
            BookSeeder::class,
            MemberSeeder::class,
            LoanSeeder::class,
        ]);

        // Buat satu user admin
        \App\Models\User::factory()->create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Password default: password
        ]);
    }
}