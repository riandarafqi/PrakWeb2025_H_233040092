<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Kolom yang dilindungi dari mass assigmetn (hanya 'id' yang tidak boleh diisi manual)
    protected $guarded = ['id']; 

    // Relasi: Satu category memiliki banyak posts (One-to-Many)
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
        // 'category_id' adalah foreign key di tabel posts yang menunjuk ke categories_id
        // Artinya: satu kategory bisa memiliki banyak postingan
    }
}