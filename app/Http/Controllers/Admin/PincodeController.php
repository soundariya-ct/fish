<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pincode;
use Illuminate\Support\Facades\Auth;

class PincodeController extends Controller
{
    public function index()
    {
        $pincodes = Pincode::get();

        return view('admin.pincode.index', compact('pincodes'));
    }

    public function create()
    {
        return view('admin.pincode.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'pincode' => 'required',
            'is_available' => 'required',
        ]);

        $datas = [
            'pincode' => $request->pincode,
            'is_available' => $request->is_available,
        ];

        Pincode::create($datas);

        return redirect()->route('admin.pincode.index')->with('success','Branch Added Successfully');
    }

    public function edit($id)
    {
        $pincode = Pincode::find($id);
        $data['pincode_value'] =  $pincode;
        $data['is_available'] = $pincode->is_available == 0 ? false : true;

        return view('admin.pincode.edit', $data);
    }

    public function Update(Request $request, $id)
    {
        $this->validate(request(), [
            'pincode' => 'required',
            'is_available' => 'required',
        ]);

        $datas = Pincode::find($id);
        $datas->pincode = $request->pincode;
        $datas->is_available = $request->is_available;
        $datas->save();

        return redirect()->route('admin.pincode.index')->with('success','Branch Updated Successfully');

    }

    public function destroy($id)
    {
        Pincode::find($id)->delete();

        return redirect()->route('admin.pincode.index')->with('success', 'Pincode Deleted Successfully');
    }
}
