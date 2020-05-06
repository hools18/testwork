<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section  extends Model
{
    protected $table = 'sections';
    protected $guarded = ['id'];

    public function news()
    {
        return $this->belongsToMany(News::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function child()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}