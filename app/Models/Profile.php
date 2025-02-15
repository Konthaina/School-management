<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'address',
        'profile_picture',
        'date_of_birth',
        'institution',
        'bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
