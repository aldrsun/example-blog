<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['slug', 'name'];

    public $timestamps = false;

    use HasFactory;

    public function posts() {
        return $this->belongsToMany(Post::class, 'posts_categories', 'category_id', 'post_id');
    }

    public function postCategory() {
        return $this->hasMany(PostCategory::class);
    }
}
