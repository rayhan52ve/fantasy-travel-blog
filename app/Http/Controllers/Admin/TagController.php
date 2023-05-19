<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $tags = new Tag;
            $limit = 10;
            $offset = 0;
            $search = [];
            $where = [];
            $with = ['post'];
            $join = [];
            $orderBy = [];

            if($request->input('length')){
                $limit = $request->input('length');
            }

            if ($request->input('order')[0]['column'] != 0) {
                $column_name = $request->input('columns')[$request->input('order')[0]['column']]['name'];
                $sort = $request->input('order')[0]['dir'];
                $orderBy[$column_name] = $sort;
            }

            if($request->input('start')){
                $offset = $request->input('start');
            }

            if($request->input('search') && $request->input('search')['value'] != ""){
                $search['title'] = $request->input('search')['value'];
                
            }

            if($request->input('where')){
                $where = $request->input('where');
            }

            $tags = $tags->getDataForDataTable($limit, $offset, $search, $where, $with, $join, $orderBy,  $request->all());
            return response()->json($tags);
        }

        return view('admin.tag.tag');

    }

    public function getAllPost()
    {
        $post = Post::latest()->get();
        return response()->json($post);
        // dd($post);
    
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
        $data = [
            'post_id' => $request->post_id,
            'name' => $request->name,
        ];

        Tag::create($data);
        return response()->json();
        }
      
    

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return response()->json($tag);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return response()->json($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Tag $tag)
    {
        $data = [
            'post_id' => $request->post_id,
            'name' => $request->name,
        ];

        $tag->update($data);
        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
    }


}
