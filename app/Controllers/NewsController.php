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

        if (!empty((int)$request->news_id)) {
            $news = News::find((int)$request->news_id);
            if (empty($news)) {
                return json_encode([
                    'data' => [],
                    'status' => 404,
                    'message' => 'News not found'
                ], 404);
            }

            $data = [
                'data' => [
                    'id' => $news->id,
                    'title' => $news->title,
                    'subtitle' => $news->subtitle,
                    'text' => $news->text,
                    'author_id' => $news->author_id,
                    'sections' => $news->sections->keyBy('id')->keys(),
                ],
                'status' => 200
            ];
            return json_encode($data);
        }

        $data = [
            'data' => News::orderBy('id', 'desc')->take(50)->get()->map(function ($news) {
                return [
                    'id' => $news->id,
                    'title' => $news->title,
                    'subtitle' => $news->subtitle,
                    'text' => $news->text,
                    'author_id' => $news->author_id,
                    'sections' => $news->sections->keyBy('id')->keys(),
                ];
            }),
            'status' => 200
        ];

        return json_encode($data);
    }

    public function search(Request $request)
    {

        if (empty($request->search)) {
            return json_encode([
                'data' => [],
                'status' => 404,
                'message' => 'Search string not found'
            ], 404);
        }

        $data = [
            'data' => News::where('title', 'LIKE', '%'.$request->search.'%')->take(10)->get()->map(function ($news) {
                return [
                    'id' => $news->id,
                    'title' => $news->title,
                    'subtitle' => $news->subtitle,
                    'text' => $news->text,
                    'author_id' => $news->author_id,
                    'sections' => $news->sections->keyBy('id')->keys(),
                ];
            }),
            'status' => 200,
            'message' => ''
        ];

        return json_encode($data);

    }
}