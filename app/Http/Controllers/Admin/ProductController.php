<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->when(request()->q, function ($products) {
            $products = $products->where('title', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $request->except('_token');

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        $product['image'] = $image->hashName();
        $product['slug'] = Str::slug($product['title'], '-');

        $simpan = Product::create($product);

        if ($simpan) {
            return redirect()->route('admin.product.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('admin.product.index')->with(['error' => 'Data Gagal Disimpan']);
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
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->except(['_token', '_method']);
        $data['slug'] = Str::slug($data['title'], '-');

        if ($request->file('image') <> '') {
            // hapus foto lama
            Storage::disk('local')->delete('public/products/' . basename($product->image));

            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());
            $data['image'] = $image->hashName();
        }

        // update
        $update = $product->update($data);

        if ($update) {
            return redirect()->route('admin.product.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('admin.product.index')->with(['error' => 'Data Gagal Disimpan']);
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
        $product = Product::findOrFail($id);
        Storage::disk('local')->delete('public/products/' . basename($product->image));
        $product->delete();

        if ($product) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        };
    }
}
