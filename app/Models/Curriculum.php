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
        'language'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curriculumDetails()
    {
        return $this->hasMany(CurriculumDetail::class);
    }
}
