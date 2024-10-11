<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;


    protected $fillable = [
        'title', 
        'author', 
        'publisher', 
        'year_published', 
        'isbn', 
        'category_id', 
        'urlFoto', 
        'urlPDF',
        'deskripsi',
        'status',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public function category()
    {
        return $this->belongsTo(Kategori::class, 'category_id');
    }
}

