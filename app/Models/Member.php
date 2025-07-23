<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nim',
        'major',
        'email',
        'is_active',
    ];

    // Relasi dengan peminjaman
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}