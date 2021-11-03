<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;

use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = Admin::orderBy('id','DESC')->paginate(5);

        return view('admin.users.index',compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();

        return view('admin.users.create',compact('roles'));
    }
   
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password',
        'roles' => 'required',
        'otp' => 'required',
        'phone' => 'required',
        'referral_code' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['pincode'] = 56678;
        $input['status'] = 1;

        $user = Admin::create($input);
        $user->assignRole($request->input('roles')) ;

        return redirect()->route('admin.users.index')
                ->with('success','User created successfully');
    }

    public function show($id)
    {
        $user = Admin::find($id);

        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input,array('password'));
        }
        $user = Admin::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        Admin::find($id)->delete();

        return redirect()->route('users.index')
                ->with('success','User deleted successfully');
    }
}
