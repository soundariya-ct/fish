<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Slot;
use Carbon\Carbon;

class SlotController extends Controller
{
    public function index()
    {
        $slots = Slot::get();

        return view('admin.slot.index', compact('slots'));

    }

    public function create()
    {
        return view('admin.slot.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'delivery_type' => 'required',
            'day_type' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $datas = [
            'delivery_type' => $request->delivery_type,
            'day_type' => $request->day_type,
            'start_time' => Carbon::parse($request->start_time),
            'end_time' => Carbon::parse($request->start_time),
        ];

        Slot::create($datas);

        return redirect()->route('admin.slot.index')->with('success','Branch Added Successfully');

    }

    public function edit($id)
    {
        $data['slot'] =  Slot::find($id);

        return view('admin.slot.edit', $data);
    }

    public function Update(Request $request, $id)
    {
        $this->validate(request(), [
            'delivery_type' => 'required',
            'day_type' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $slot = Slot::find($id);
        $slot->delivery_type = $request->delivery_type;
        $slot->day_type = $request->day_type;
        $slot->start_time = Carbon::parse($request->start_time);
        $slot->end_time = Carbon::parse($request->start_time);

        $slot->save();

        return redirect()->route('admin.slot.index')->with('success','Branch Updated Successfully');

    }

    public function destroy($id)
    {
        Slot::find($id)->delete();

        return redirect()->route('admin.slot.index')->with('success', 'Product Deleted Successfully');
    }
}
