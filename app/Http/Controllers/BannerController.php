<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:banners',
            'image' => 'required',
        ]);
        $image = $request->image->getClientOriginalName();
        $request->image->storeAs('public/images/banners', $image);
        Banner::create([
            'name' => $request->name,
            'srcImage' => $image,
        ]);
        toastr()->success('Successfully', 'Added banner');
        return redirect()->route('banner.index');
    }
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'name' => 'required',
        ]);
        if($request->image != null){
            $image = $request->image->getClientOriginalName();
            $request->image->storeAs('public/images/banners', $image);
        }else{
            $image = $banner->srcImage;
        }
        $banner->fill([
            'name' => $request->name,
            'srcImage' => $image,
        ])->save();
        toastr()->success('Successfully', 'Updated banner');
        return redirect()->route('banner.index');
    }

}