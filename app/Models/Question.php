<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $fillable = [
        'prompt',
        'response',
        'user_id',
        'language',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorite()
    {
        return $this->morphMany(FavoriteContent::class, 'content');
    }

    public function comment()
    {
        return $this->morphMany(CommentContent::class, 'content');
    }
}
