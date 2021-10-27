<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

use App\Traits\ImageTrait;

class BranchController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();

        return view('admin.branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branch.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'branch_name' => 'required',
            'branch_code' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ]);

        Branch::create($request->all());

        return redirect()->route('admin.branch.index')->with('success','Branch Added Successfully');
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
        $data = Branch::find($id);

        return view('admin.branch.edit',compact('data'));
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


}
