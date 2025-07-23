<?php
// database/seeders/MemberSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;
use Database\Factories\MemberFactory;

class MemberSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     */
    public function run(): void
    {

        Member::factory()->count(15)->create(); // Buat 15 anggota dummy lainnya
    }
}