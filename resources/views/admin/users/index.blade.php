@extends('admin.layouts.master')
@section('content')

<div class="app-content content ">
    <div class="content-overlay"></div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Roles</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Roles
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end">
                            @hasAccess('admin.users.create')
                                <a class="btn btn-success" href="{{ route('admin.users.create') }}"> Create New User</a>
                            @endhasAccess
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Tables start -->
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Roles</h4>
                        </div>
                        <div class="card-body">
                                <div class="table-responsive table-bordered">
                                    <table class="table ">
                                        <tr>
                                          <th>No</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Roles</th>
                                          <th width="280px">Action</th>
                                        </tr>
                                        @foreach ($data as $key => $user)
                                         <tr>
                                           <td>{{ ++$i }}</td>
                                           <td>{{ $user->name }}</td>
                                           <td>{{ $user->email }}</td>
                                           <td>
                                             @if(!empty($user->getRoleNames()))
                                               @foreach($user->getRoleNames() as $v)
                                               {{ $v }} 
                                               @endforeach
                                             @endif
                                           </td>
                                           <td>
                                              <a class="btn btn-info" href="{{ route('admin.users.show',$user->id) }}">Show</a>
                                              <a class="btn btn-primary" href="{{ route('admin.users.edit',$user->id) }}">Edit</a>
                                               {!! Form::open(['method' => 'DELETE','route' => ['admin.users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                   {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                               {!! Form::close() !!}
                                           </td>
                                         </tr>
                                        @endforeach
                                       </table>

                                </div>
                                <div class="d-flex justify-content-between mx-0 row mt-1">
                                    <div class="col-sm-12 col-md-6">
                                        {{-- Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} entries --}}
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-auto">
                                        {{-- {{ $categories->links('vendor.pagination.custom') }} --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic Tables end -->
        </div>
    </div>
</div>

{!! $data->render() !!}
@endsection
