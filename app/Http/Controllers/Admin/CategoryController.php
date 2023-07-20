<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->when(request()->q, function($categories){
            $categories = $categories->where('name', 'like', '%'.request()->q.'%');
        })->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/categories', $image->hashName());

        // simpan db
        $category = Category::create([
            'image' => $image->hashName(),
            'name'  => $request->name,
            'slug'  => Str::slug($request->name, '-')
        ]);

        // redirect
        if($category){
            return redirect()->route('admin.category.index')->with(['success' => 'Data Berhasil Disimpan']);
        }
        else {
            return redirect()->route('admin.category.index')->with(['error' => 'Gagal Disimpan']);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {

        $category = Category::findOrFail($id);
        if ($request->file('image')==''){
            // ubah name
            $category->update([
                'name'  => $request->name,
                'slug'  => Str::slug($request->name,'-')
            ]);
        }
        else {
            // simpan image
            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            // hapus image lama
            Storage::disk('local')->delete('public/categories/' . basename($category->image));

            $category->update([
                'name'  => $request->name,
                'image' => $image->hashName(),
                'slug'  => Str::slug($request->name,'-')
            ]);
        }


        if($category){
            return redirect()->route('admin.category.index')->with(['success' => 'Data Berhasil Diubah']);
        }
        else {
            return redirect()->route('admin.category.index')->with(['error' => 'Data Gagal Diubah']);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        Storage::disk('local')->delete('public/categories/'.basename($category->image));
        $category->delete();

        if($category){
            return response()->json(['status' => 'success']);
        }
        else {
            return response()->json(['status' => 'error']);
        };
    }
}
