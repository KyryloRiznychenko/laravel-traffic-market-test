<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'status',
    ];

    protected $appends = [
        'url'
    ];

    public function getUrlAttribute(): string
    {
        return route('news.show', ['entity' => $this->slug]);
    }
}
