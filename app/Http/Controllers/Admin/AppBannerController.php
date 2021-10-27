<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerApp;
use App\Models\Product;

class AppBannerController extends Controller
{
    public $appBanner;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->appBanner = new BannerApp();
    }

    public function index()
    {
        $datas['posts'] = BannerApp::orderBy('id','desc')->paginate(5);
        $datas['products'] = Product::pluck('english_name', 'id')->toArray();

        return view('admin.app-banner.index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.app-banner.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('public/images');
        }
        $save = new BannerApp;
        $save->banner_image = $path;
        $save->product_id = $request->product_id;
        $save->save();

       return redirect()->route('admin.app-banner.index');
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
    public function edit($id)
    {
        return view('admin.app-banner.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = BannerApp::find($id);
        if($request->hasFile('banner_image')){
            $request->validate([
              'banner_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('banner_image')->store('public/images');
            $post->banner_image = $path;
        }

        $post->save();

        return redirect()->route('admin.app-banner.index')
        ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
