<?php

namespace App\Controllers;

use App\Models\Section;

class SectionController
{
    public function index()
    {
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

    public function show($section_id)
    {
        $section = Section::find($section_id);
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

    public function getNews()
    {
        return 1;
    }
}