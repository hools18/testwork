<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\News;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController
{
    public function index(Request $request)
    {
        if (!empty((int)$request->section_id)) {

            $section = Section::find((int)$request->section_id);

            if (empty($section)) {
                return json_encode([
                    'data' => [],
                    'status' => 404,
                    'message' => 'Section not found'
                ], 404);
            }

            $data = [
                'data' => [
                    'id' => $section->id,
                    'name' => $section->name,
                    'child' => $section->child->map(function ($child) {
                        return [
                            'id' => $child->id,
                            'name' => $child->name,
                        ];
                    })
                ],
                'status' => 200
            ];

            return json_encode($data);
        }
        $data = [
            'data' => Section::orderBy('name')->get()->map(function ($section) {
                return [
                    'id' => $section->id,
                    'name' => $section->name,
                    'child' => $section->child->map(function ($child_section) {
                        return [
                            'id' => $child_section->id,
                            'name' => $child_section->name,
                        ];
                    })
                ];
            }),
            'status' => 200
        ];

        return json_encode($data);
    }

    public function getNews(Request $request)
    {
        if (!empty((int)$request->section_id)) {
            $section = Section::find((int)$request->section_id);
            if (empty($section)) {
                return json_encode([
                    'data' => [],
                    'status' => 404,
                    'message' => 'Section not found'
                ], 404);
            }
            $data = [
                'data' => News::join('news_section', 'news.id', '=', 'news_section.news_id')
                    ->where('news_section.section_id', $section->id)->get()->map(function ($news) {
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
            'message' => 'Not found section_id'
        ], 404);
    }
}