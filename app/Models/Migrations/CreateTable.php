<?php

namespace App\Models\Migrations;

use App\Models\Author;
use App\Models\News;
use App\Models\Section;
use Faker\Factory;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateTable
{
    public static function up()
    {

        if (!Capsule::schema()->hasTable('authors')) {
            echo 'Создаем таблицу с авторами<br>'.PHP_EOL;
            Capsule::schema()->create('authors', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->text('image_url');
                $table->text('description');
                $table->timestamps();
                $table->index(['name', 'id']);
            });
            echo 'Tаблица с авторами создана<br>'.PHP_EOL;
        };
        if (!Capsule::schema()->hasTable('news')) {
            echo 'Создаем таблицу с материалами<br>'.PHP_EOL;
            Capsule::schema()->create('news', function ($table) {
                $table->increments('id');
                $table->string('title');
                $table->text('subtitle');
                $table->text('text');
                $table->integer('author_id');
                $table->timestamps();
                $table->index(['id', 'title', 'author_id']);
            });
            echo 'Таблицу с материалами создана<br>'.PHP_EOL;
        }
        if (!Capsule::schema()->hasTable('sections')) {
            echo 'Создаем таблицу с разделами<br>'.PHP_EOL;
            Capsule::schema()->create('sections', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('parent_id')->nullable();
                $table->timestamps();
                $table->index(['id', 'parent_id']);
            });
            echo 'Таблицу с разделами создана<br>'.PHP_EOL;
        }
        if (!Capsule::schema()->hasTable('news_section')) {
            echo 'Создаем промежуточную таблицу связь новость - раздел<br>'.PHP_EOL;
            Capsule::schema()->create('news_section', function ($table) {
                $table->integer('news_id');
                $table->integer('section_id');
                $table->index(['news_id', 'section_id']);
            });
            echo 'Промежуточная таблица связь новость - раздел создана<br>'.PHP_EOL;
        }
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < 50; $i++) {
            Author::create([
                'name' => $faker->name,
                'image_url' => $faker->imageUrl(),
                'description' => $faker->text(150),
            ]);
        }
        echo 'Заполняем данными таблицу авторов<br>'.PHP_EOL;
        for ($i = 0; $i < 100; $i++) {
            Section::create([
                'name' => $faker->company,
                'parent_id' => Section::all()->isEmpty() ?  null : Section::all()->random()->id,
            ]);
        }
        echo 'Заполняем данными таблицу разделов<br>'.PHP_EOL;
        for ($i = 0; $i < 1000; $i++) {
            $news = News::create([
                'title' => $faker->text(80),
                'subtitle' => $faker->text(250),
                'text' => $faker->text(600),
                'author_id' => Author::all()->random()->id,
            ]);

            $news->sections()->attach(Section::all()->random()->id);

            $news->save();
        }
        echo 'Заполняем данными таблицу материалов<br>'.PHP_EOL;
    }

    public static function down()
    {
        echo 'Удаляем все таблицы<br>'.PHP_EOL;
        Capsule::schema()->dropIfExists('authors');
        Capsule::schema()->dropIfExists('news');
        Capsule::schema()->dropIfExists('sections');
        Capsule::schema()->dropIfExists('news_section');

    }
}