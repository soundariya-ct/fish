<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\BannerApp;
use App\Traits\ImageTrait;

class CategoryController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->paginate(25);
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::select('id','name','status','parent_id')
                    ->whereNull('parent_id')
                    ->with('getChildrenCategory')
                    ->active()->get();
        return view('admin.category.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(request('slug') != null){
            $request['slug']  = Str::slug(request('slug'),'-');
        }else{
            $request['slug']  = Str::slug(request('name'),'-');
        }

        $this->validate(request(),[
            'name' => 'required|unique:categories,name',
            'slug' => 'required|alpha_dash|unique:categories,slug',
        ]);

        $path = null;

        if($request->file('image')){
            $file = $request->file('image');
            $file_arr = $this->upload_file($file,'category');
            $path = $file_arr['db_path'];
        }

        Category::create([
            'name' => request('name'),
            'status' => request('status'),
            'slug' => request('slug'),
            'parent_id' =>request('parent_id'),
            'created_by' => Auth::User()->id,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'image' => $path
        ]);

        return redirect()->route('admin.category.index')->with('success','Category Added Successfully');
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
        $category = Category::select('id','name','status','parent_id')
                    ->whereNull('parent_id')
                    ->with('getChildrenCategory')
                    ->active()->get();
        $data = Category::find($id);
        return view('admin.category.edit',compact('data','category'));
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
        if(request('slug') != null){
            $request['slug']  = Str::slug(request('slug'),'-');
        }else{
            $request['slug']  = Str::slug(request('name'),'-');
        }

        $this->validate(request(),[
            'name' => 'required|unique:categories,name,'.$id,
            'slug' => 'required|alpha_dash|unique:categories,slug,'.$id,
        ]);

        $path = null;

        if($request->file('image')){
            $file = $request->file('image');
            $file_arr = $this->upload_file($file,'category');
            $path = $file_arr['db_path'];
        }

        $datas = [
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'image' => $path
        ];

        if($path == null){
            unset($datas['image']);
        }

        Category::where('id',$id)->update($datas);
        return redirect()->route('admin.category.index')->with('success','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('admin.category.index')->with('success','Category Deleted Successfully');
    }

    public function app_banner()
    {
        $data['posts'] = BannerApp::orderBy('id','desc')->paginate(5);

        return view('admin.category.app_banner', $data);
    }

    public function store_appbanner(Request $request)
    { 
        if ($request->hasFile('banner_image')) {
             $path = $request->file('banner_image')->store('public/images');
        }
        $save = new BannerApp;
        $save->banner_image = $path;
        $save->save();

        return redirect()->route('admin.app_banner');
    }
}
