<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $categories = new Category();
            $limit = 10;
            $offset = 0;
            $search = [];
            $where = [];
            $with = ['parent'];
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
                $search['name'] = $request->input('search')['value'];
            }

            if ($request->input('where')) {
                $where = $request->input('where');
            }

            $categories = $categories->getDataForDataTable($limit, $offset, $search, $where, $with, $join, $orderBy,  $request->all());
            return response()->json($categories);
        }

        return view('Admin.category.index');

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

    //     $request->validate([
    //         'name'=> 'required',
    //         'parent_id'=> 'required|unique'
    //     ],
    //      $message=[
    //         'name.required'=>'Please Enter Name',
    //         'parent_id.required'=>'Please Enter parent id',
    //         'parent_id.unique'=>'Parent id must be unique',
    //      ]
    
    
    //    );

        if ($request->parent_id) {
            $subcategory = $request->parent_id;
        } else {
            $subcategory = 0;
        }

        $category = [
            'name' => $request->name,
            'parent_id'=>$subcategory
        ];

        Category::create($category);
        return response()->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        // $request->validate([
        //     'name'=> 'required',
        //     'parent_id'=> 'required|unique'
        // ],
        // $message=[
        //    'name.required'=>'Please Enter Name',
        //    'parent_id.required'=>'Please Enter parent id',
        //    'parent_id.unique'=>'Parent id must be unique',
        // ]
        //   );

        
        if ($request->parent_id) {
            $subcategory = $request->parent_id;
        } else {
            $subcategory = 0;
        }

        $data = [
            'name' => $request->name,
            'parent_id'=>$subcategory,
        ];

        $category->update($data);
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();


    }

    public function getSubcategory()
    {
        $getCategories = Category::select('id', 'name', 'parent_id')->get();

        return response()->json($getCategories);
    }
}
