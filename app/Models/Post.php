<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,CommonTrait;

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    protected $fillable = [
        'category_id',
        'admin_id',
        'title',
        'content',
        'image',
        'video'

    ];


}
