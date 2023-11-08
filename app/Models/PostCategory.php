<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostCategory extends Pivot
{
    use HasFactory;
    protected $table = 'posts_categories';
    public $timestamps = false;
    protected $fillable = ['post_id', 'category_id', 'user_id'];
}
