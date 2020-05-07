<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\News;
use Illuminate\Http\Request;

class AuthorController
{
    public function index(Request $request)
    {
        if (!empty((int)$request->author_id)) {
            $author = Author::find((int)$request->author_id);
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
                'status' => 200,
                'message' => ''
            ];
            return json_encode($data);
        }

        $data = [
            'data' => Author::orderBy('name')->get()->map(function ($author) {
                return [
                    'id' => $author->id,
                    'name' => $author->name,
                    'image' => $author->image_url,
                ];
            }),
            'status' => 200,
            'message' => ''
        ];

        return json_encode($data);
    }

    public function getNews(Request $request)
    {
        if (!empty((int)$request->author_id)) {
            $author = Author::find((int)$request->author_id);
            if (empty($author)) {
                return json_encode([
                    'data' => [],
                    'status' => 404,
                    'message' => 'Author not found'
                ], 404);
            }
            $data = [
                'data' => News::where('author_id', $author->id)->get()->map(function ($news) {
                        return [
                            'id' => $news->id,
                            'title' => $news->title,
                            'subtitle' => $news->subtitle,
                            'text' => $news->text,
                        ];
                    }),
                'status' => 200,
                'message' => ''
            ];
            return json_encode($data);
        }

        return json_encode([
            'data' => [],
            'status' => 404,
            'message' => 'Not found author_id'
        ], 404);

    }
}