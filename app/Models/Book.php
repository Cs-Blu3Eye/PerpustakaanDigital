<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'stock',
        'cover_image',
    ];

    // Relasi dengan peminjaman
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
