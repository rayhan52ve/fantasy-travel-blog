<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{


    public function frontend(){
        $posts = Post::get();
        return view('frontend.module.main',compact('posts'));
    }

    public function category(){
        $categories = Category::with('post')->get();
        $tags = Tag::get();
        // dd($categories);
        return view('frontend.module.category',compact('categories','tags'));
    }

    public function categoryChield($id){
        $category = Category::get();
        $tags = Tag::get();
        $categories = Category::with('post')->find($id);
        // dd($categories);
        return view('frontend.module.categoryChield',compact('categories','category','tags'));
    }

    public function archive(){
        $posts = Post::get();
        // dd($posts);
        return view('frontend.module.archive',compact('posts'));
    }

    public function postDetails($id){
        $post = Post::withCount('admin','comment')->find($id);
        $categories = Category::get();
        $tags = Tag::get();
        return view('frontend.module.post-detail',compact('post','categories','tags'));
    }

    public function contact(){
        return view('frontend.module.contact');
    }

}
