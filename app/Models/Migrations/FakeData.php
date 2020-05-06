<?php

namespace App\Models\Migrations;

use App\Models\Author;
use App\Models\News;
use App\Models\Section;
use Faker\Factory;

class FakeData
{
    public static function add_data()
    {
        $faker = Factory::create('ru_RU');

        for ($i = 0; $i < 50; $i++) {
            Author::create([
                'name' => $faker->name,
                'image_url' => $faker->imageUrl(),
                'description' => $faker->text(150),
            ]);
        }
        for ($i = 0; $i < 100; $i++) {
            Section::create([
                'name' => $faker->company,
                'parent_id' => Section::all()->isEmpty() ?  null : Section::all()->random()->id,
            ]);
        }
        for ($i = 0; $i < 25000; $i++) {
           $news = News::create([
                'title' => $faker->text(80),
                'subtitle' => $faker->text(250),
                'text' => $faker->text(600),
                'author_id' => Author::all()->random()->id,
            ]);

            $news->sections()->attach(Section::all()->random()->id);

            $news->save();
        }

    }

}