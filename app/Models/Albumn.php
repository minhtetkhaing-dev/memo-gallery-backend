<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Albumn extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'cover_image_path',
        'user_id',
        'parent_id',
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function parentAlbumn() {
        return $this->belongsTo(Albumn::class, 'parent_id');
    }

    public function childAlbumns()
    {
        return $this->hasMany(Albumn::class, 'parent_id');
    }

    public function photos() {
        return $this->hasMany(Photo::class);
    }
}
