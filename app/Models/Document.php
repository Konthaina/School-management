<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'publication_year',
        'keywords',
        'file_path',
        'author',
        'field',
        'genre',
    ];

    /**
     * Relationship with the User model (the user who uploaded the document).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Comments associated with the document.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Evaluations associated with the document.
     */
}
