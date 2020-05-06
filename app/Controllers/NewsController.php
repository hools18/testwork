<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\Migrations\CreateTable;
use App\Models\Migrations\FakeData;
use App\Models\News;
use App\Models\Section;
use Faker\Factory;
use Illuminate\Http\Request;

class NewsController
{
    public static function index(Request $request)
    {


//        CreateTable::down();
//        CreateTable::up();
//        FakeData::add_data();

//        $news = News::find(1);
//        dd($news->author, $news->sections);

        return 123123;
    }
}