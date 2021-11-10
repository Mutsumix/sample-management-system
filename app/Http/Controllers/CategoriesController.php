<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Only authenticated users can access this controller
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::Paginate(5);
        return view('sys_mg.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new source.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.categories.create');
    }

    /**
     * Store a newly created resource in storage
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required:1|unique:categories',
        ]);

        $category = new Category;
        $category->category_name = $request->input('category_name');
        $category->save();

        return redirect('/categories')->with('info', '事業区分が作成されました！');
    }

    /**
     * Display the specified resource
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('sys_mg.categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_name' => 'required|unique:categories|min:1',
        ]);
        $category = Category::Find($id);
        $category->category_name = $request->input('category_name');
        $category->save();
        return redirect('/categories')->with('info', '事業区分が更新されました！');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/categories')->with('info', '事業区分が削除されました！');
    }
}
