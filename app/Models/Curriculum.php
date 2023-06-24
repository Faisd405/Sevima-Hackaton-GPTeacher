<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    protected $fillable = [
        'user_id',
        'prompt',
        'description',
        'language',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curriculumDetails()
    {
        return $this->hasMany(CurriculumDetail::class);
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
