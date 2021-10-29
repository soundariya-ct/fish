<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Country;
use App\Models\State;
use App\Models\City;



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
        $country = Country::pluck('name', 'id')->toArray();

        return view('admin.branch.create', compact('country'));
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
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
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
        $branch =  Branch::find($id);
        $data['branch'] =  $branch;
        $data['country_name'] = Country::find($branch->country_id)->id;
        $data['state_name'] = State::find($branch->state_id)->id;
        $data['city_name'] = City::find($branch->city_id)->id;
        $data['country'] = Country::pluck('name', 'id')->toArray();
        $data['state'] = State::where('id', $branch->state_id)->pluck('name', 'id')->toArray();
        $data['city'] = City::where('id', $branch->city_id)->pluck('name', 'id')->toArray();

        return view('admin.branch.edit', $data);
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
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ]);

        $branch = Branch::find($id);
        $branch->branch_name =  $request->get('branch_name');
        $branch->branch_code = $request->get('branch_code');
        $branch->country_id = $request->get('country_id');
        $branch->state_id = $request->get('state_id');
        $branch->city_id = $request->get('city_id');
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

    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)
                        ->get(["name","id"]);

        return response()->json($data);
    }

    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)
                        ->get(["name","id"]);
        return response()->json($data);
    }
}
