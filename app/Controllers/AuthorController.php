<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\News;

class AuthorController
{
    public function index()
    {
        $data = [
            'data' => Author::orderBy('name')->get()->map(function ($author) {
                return [
                    'id' => $author->id,
                    'name' => $author->name,
                    'image' => $author->image_url,
                ];
            }),
            'status' => 200
        ];

        return json_encode($data);
    }

    public function show($author_id)
    {
        $author = Author::find($author_id);
        if (empty($author)) {
            return json_encode([
                'data' => [],
                'status' => 404,
                'message' => 'Author not found'
            ], 404);
        }

        $data = [
            'data' => [
                'id' => $author->id,
                'name' => $author->name,
                'image' => $author->image_url,
            ],
            'status' => 200
        ];
        return json_encode($data);
    }

    public function getNews($author_id)
    {
        $author = Author::find($author_id);
        if (empty($author)) {
            return json_encode([
                'data' => [],
                'status' => 404,
                'message' => 'Author not found'
            ], 404);
        }
        $data = [
            'data' => News::join('news_section', 'news.id', '=', 'news_section.news_id')
                ->where('news_section.section_id', $author_id)->get()->map(function ($news) {
                    return [
                        'id' => $news->id,
                        'title' => $news->title,
                        'subtitle' => $news->subtitle,
                        'text' => $news->text,
                    ];
                }),
            'status' => 200
        ];
        return json_encode($data);
    }
}