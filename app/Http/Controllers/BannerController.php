<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->get();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        toastr()->success('Successfully', 'Deleted banner');
        return redirect()->route('banner.index');
    }
}
