<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    public function projects()
    { //scrittura per projects che in questo caso corrisponde al many di one to may

        return $this->hasMany(Project::class);
    }
}