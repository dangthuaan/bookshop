<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CategoryRequest;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Http\Controllers\Controller;
use Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$categories = Category::whereNull('parent_id')->get();

        $categories = Category::all();

        return view('admin.categories.category-manager', compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.categories.create-category', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->only([
            'name',
            'parent_id'
        ]);
        
        if($data['parent_id'] == 0){
            unset($data['parent_id']);
        } //delete parent_id if is null
        try {
            $category = Category::create($data);
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('createFailed', 'Create failed!');
        }
        return redirect('/admin/categories')->with('status', 'Create success!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('to this');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $categories = Category::all();

        return view('admin.categories.edit-category', compact('categories'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request)
    {
        $data = $request->only([
            'name',
            'parent_id'
        ]);
        
        if($data['parent_id'] == 0){
            $data['parent_id'] = null;
        } //delete parent_id if is null
        
        $category = Category::where('parent_id', $data['parent_id']);
        
        try {
            $category->update($data);

        } catch (Exception $e) {
            Log::error($e);
            return back()->with('createFailed', 'Create failed!');
        }
        return redirect('/admin/categories')->with('status', 'Create success!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $category = Category::where('parent_id', $data['parent_id']);
        try {
            $book->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->with('status', 'Delete failed.');
        }
        return redirect('admin/books')->with('status', 'Delete success');
    }
}