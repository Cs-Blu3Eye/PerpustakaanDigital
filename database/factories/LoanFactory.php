<?php

namespace Database\Factories;


use App\Models\Loan;
use App\Models\Member;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Loan::class;

    public function definition(): array
    {
        // Random tanggal peminjaman 1 tahun ke belakang
        $loanDate = $this->faker->dateTimeBetween('-1 year', 'now');
        
        // 50% kemungkinan sudah dikembalikan
        $isReturned = $this->faker->boolean(50);
        
        return [
            'member_id' => Member::inRandomOrder()->first()?->id ?? Member::factory(), // fallback ke factory jika kosong
            'book_id' => Book::inRandomOrder()->first()?->id ?? Book::factory(),
            'loan_date' => $loanDate,
            'return_date' => $isReturned ? (clone $loanDate)->modify('+'.rand(1, 30).' days') : null,
            'status' => $isReturned ? 'returned' : 'borrowed',
        ];
    }
}
