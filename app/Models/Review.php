<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';

    protected $fillable = [
        'phone_id',
        'reviewer_name',
        'comment',
        'rating',
        'ip_address',
        'region'
    ];

}
