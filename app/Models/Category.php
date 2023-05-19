<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,CommonTrait;


    public function post(){
        return $this->hasMany(Post::class);
    }

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id');
    }

    protected $fillable = [
        'name',
        'parent_id',
    ];

}
