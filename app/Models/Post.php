<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $casts = [
        'data' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'titulo',
        'texto',
        'assunto',
        'img',
        'owner',
        'data',
    ];

    protected static function booted()
    {
        static::deleting(function ($post) {
            if ($post->img && Storage::disk('public')->exists($post->img)) {
                Storage::disk('public')->delete($post->img);
            }
        });
    }
}
