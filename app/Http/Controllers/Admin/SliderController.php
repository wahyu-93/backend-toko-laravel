<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        // simpan foto
        $image = $request->file('image');
        $image->storeAs('public/sliders', $image->hashName());

        $simpan = Slider::create([
            'image' => $image->hashName(),
            'link' => $request->link
        ]);

        if ($simpan) {
            return redirect()->route('admin.slider.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('admin.slider.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $image = Storage::disk('local')->delete('public/sliders/' . basename($slider->image));
        $slider->delete();

        if ($slider) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
}
