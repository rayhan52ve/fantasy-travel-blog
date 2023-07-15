<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Post;
// use App\Models\User; 
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        if ($request->wantsJson()) {
            $post = new Post();
            $limit = 10;
            $offset = 0;
            $search = [];
            $where = [];
            $with = ['category','admin'];
            $join = [];
            $orderBy = [];

            if ($request->input('length')) {
                $limit = $request->input('length');
            }

            if ($request->input('order')[0]['column'] != 0) {
                $column_name = $request->input('columns')[$request->input('order')[0]['column']]['name'];
                $sort = $request->input('order')[0]['dir'];
                $orderBy[$column_name] = $sort;
            }

            if ($request->input('start')) {
                $offset = $request->input('start');
            }

            if ($request->input('search') && $request->input('search')['value'] != "") {
                $search['title'] = $request->input('search')['value'];
            }

            if ($request->input('where')) {
                $where = $request->input('where');
            }

            $post = $post->getDataForDataTable($limit, $offset, $search, $where, $with, $join, $orderBy, $request->all());
            return response()->json($post);
        }

        return view('admin.post.index');

    }



    public function getadmin(){
        $admin = Admin::latest()->get();
        return response()->json($admin);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod("post")){

            if ($request->hasFile('image')) {
                $image_temp = $request->file('image');

                    $extention = $image_temp->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extention;
                    $imagePath = 'assets/uploads/post/'.$imageName;
                    Image::make($image_temp)->resize(895, 552)->save($imagePath);
               
            }
        $data = [
            'category_id' => $request->category_id,
            'admin_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'video' => $request->video,
            'image' => $imagePath,
            
            ];
            Post::create($data);
            return response()->json();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // dd($request->all());
        if($request->isMethod("put")){

            if ($request->hasFile('image')) {
                $image_temp = $request->file('image');

                    $extention = $image_temp->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extention;
                    $imagePath = 'assets/uploads/post/'.$imageName;
                    Image::make($image_temp)->resize(895, 552)->save($imagePath);
               
            }elseif($post->id){
                $post = Post::where('id', $post->id)->select('id', 'image')->first();
                $imagePath = $post->image;
            }
            $data = [
                'category_id' => $request->category_id,
                'admin_id' => Auth::guard('admin')->user()->id,
                'title' => $request->title,
                'content' => $request->content,
                'video' => $request->video,
                'image' => $imagePath,
                ];
                $post->update($data);
            return response()->json('success');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        $post->delete();
    }

    public function getAllCategory(){
        $category = Category::latest()->get();
        return response()->json($category);
    }
}
