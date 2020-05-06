<?php

namespace App\Models\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateTable
{
    public static function up()
    {
        if (!Capsule::schema()->hasTable('authors')) {
            Capsule::schema()->create('authors', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->text('image_url');
                $table->text('description');
                $table->timestamps();
            });
        };
        if (!Capsule::schema()->hasTable('news')) {
            Capsule::schema()->create('news', function ($table) {
                $table->increments('id');
                $table->string('title');
                $table->text('subtitle');
                $table->text('text');
                $table->integer('author_id');
                $table->timestamps();
            });
        }
        if (!Capsule::schema()->hasTable('sections')) {
            Capsule::schema()->create('sections', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('parent_id')->nullable();
                $table->timestamps();
            });
        }
        if (!Capsule::schema()->hasTable('news_section')) {
            Capsule::schema()->create('news_section', function ($table) {
                $table->integer('news_id');
                $table->integer('section_id');
            });
        }
    }

    public static function down()
    {
        Capsule::schema()->dropIfExists('authors');
        Capsule::schema()->dropIfExists('news');
        Capsule::schema()->dropIfExists('sections');
        Capsule::schema()->dropIfExists('news_section');

    }
}