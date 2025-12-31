<?php

namespace Database\Seeders;

use App\Models\Property\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['district_Name' => 'ناحیه اول'],
            ['district_Name' => 'ناحیه دوم'],
            ['district_Name' => 'ناحیه سوم'],
            ['district_Name' => 'ناحیه چهارم'],
            ['district_Name' => 'ناحیه پنجم'],
            ['district_Name' => 'ناحیه ششم'],
            ['district_Name' => 'ناحیه هفتم'],
            ['district_Name' => 'ناحیه هشتم'],
            ['district_Name' => 'ناحیه نهم'],
            ['district_Name' => 'ناحیه دهم'],
            ['district_Name' => 'ناحیه یازدهم'],
            ['district_Name' => 'ناحیه دوازدهم'],
            ['district_Name' => 'ناحیه سیزدهم'],
            ['district_Name' => 'ناحیه چهاردهم'],
            ['district_Name' => 'ناحیه پانزدهم'],
            ['district_Name' => 'ناحیه شانزدهم'],
            ['district_Name' => 'ناحیه هفدهم'],
            ['district_Name' => 'ناحیه هجدهم'],
            ['district_Name' => 'ناحیه نوزدهم'],
            ['district_Name' => 'ناحیه بیستم'],
            ['district_Name' => 'ناحیه بیست و یکم'],
            ['district_Name' => 'ناحیه بیست و دوم'],
        ];

        foreach ($districts as $district) {
            District::create($district);
        }
    }
}
