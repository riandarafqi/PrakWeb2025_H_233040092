<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use hasFactory;

    //Kolom yang dilindungi dari mass assignment (hanya 'id yang tidak boleh diisi manual)
    protected $guaeded = ['id'];

    // relasi: satu category memiliki banyak post (One-to-Many)
    public function posts(): HasMany{
        return $this->hasMany(Post::class, 'category_id');
    }
}
