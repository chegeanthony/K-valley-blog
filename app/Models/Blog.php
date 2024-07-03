<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'is_published',
        'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
}