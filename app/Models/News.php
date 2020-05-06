<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $guarded = ['id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }
}