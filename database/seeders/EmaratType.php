<?php

namespace Database\Seeders;

use App\Models\emaratType as ModelsEmaratType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class EmaratType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $EmaratTypes = [
            ['emarat_Type_Name' => 'اعمارات اصلی(متر مکعب)'],
            ['emarat_Type_Name' => ' تهکوی(متر مکعب)'],
            ['emarat_Type_Name' => ' الحاقیه(متر مکعب)'],
            ['emarat_Type_Name' => ' دیوار(متر مکعب)'],
            ['emarat_Type_Name' => ' زمین(متر مربع)'],
        ];
        foreach ($EmaratTypes as $EmaratType) {
            ModelsEmaratType::create($EmaratType);
        }
    }
}
