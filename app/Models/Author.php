<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Author extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'phone_number',
        'email',
        'bio',
        'website',
        'social_media',
        'profession',
    ];

    protected $casts = [
        'social_media' => 'array',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function getBlogs()
    {
        return $this->hasMany(Blog::class, 'author_id', 'id')->get();
    }

    public function updateAuthorProfile(array $attributes = [])
    {
        return $this->update($attributes);
    }

    public function createNewBlog(array $attributes = [])
    {
        return $this->hasMany(Blog::class, 'author_id', 'id')->create($attributes);
    }
}
