<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'book_id',
        'loan_date',
        'return_date',
        'status',
    ];

    // Relasi dengan anggota
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Relasi dengan buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
