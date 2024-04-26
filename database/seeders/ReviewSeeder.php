<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Phone;
use App\Models\Review;
use Psy\Util\Str;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $phones = Phone::all(); // Lấy tất cả phones
//faker
        foreach ($phones as $phone) {
            Review::factory()->create([
                'phone_id' => $phone->id,
                'comment' => "orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley",
                'rating' => 'Scam',
            ]); // Tạo review cho mỗi phone
        }
    }
}

