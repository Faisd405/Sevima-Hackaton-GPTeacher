<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'file_name',
        'path',
        'description',
        'is_download',
    ];

    protected $appends = ['file_path'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFilePathAttribute()
    {
        return asset('storage/'.$this->path);
    }
}
