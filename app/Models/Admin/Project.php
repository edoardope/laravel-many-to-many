<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'cover_image',
        'type_id',
    ];

    public function type()
    { //scrittura per type che in questo caso corrisponde al one di one to may

        return $this->belongsTo(Type::class);
    }
}