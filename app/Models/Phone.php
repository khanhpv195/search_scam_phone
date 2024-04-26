<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $table = 'phones';
    protected $fillable = [
        'business_name',
        'phone_number',
        'additional_info',
        'status'
    ];



    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
