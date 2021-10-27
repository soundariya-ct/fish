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
        return view('admin.branch.create');
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

        $branch = Branch::find($id);
        $branch->branch_name =  $request->get('branch_name');
        $branch->branch_code = $request->get('branch_code');
        $branch->country = $request->get('country');
        $branch->state = $request->get('state');
        $branch->city = $request->get('city');
        $branch->phone = $request->get('phone');
        $branch->address = $request->get('address');
        $branch->lat = $request->get('lat');
        $branch->long = $request->get('long');

        $branch->save();

        return redirect()->route('admin.branch.index')->with('success','Branch Updated Successfully');
    }

    public function destroy($id)
    {
        Branch::find($id)->delete();

        return redirect()->route('admin.branch.index')->with('success','Category Deleted Successfully');
    }

}
