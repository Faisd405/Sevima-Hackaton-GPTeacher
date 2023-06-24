<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumDetail extends Model
{
    use HasFactory;

    protected $table = 'curriculum_details';

    protected $fillable = [
        'curriculum_id',
        'title',
        'content',
        'order'
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
