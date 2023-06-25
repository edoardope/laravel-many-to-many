<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Type;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'FrontEnd',
            'Backend',
            'FullStack',
            'Design'
        ];

        foreach ($types as $elem) {
            $new_cat = new Type();
            $new_cat->name = $elem;
            $new_cat->slug = Str::slug($new_cat->name);
            $new_cat->save();

        }
    }
}