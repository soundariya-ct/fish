@extends('admin.layouts.master')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Branch</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active">Branch
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
                                    <a class="dropdown-item" href="{{ route('admin.branch.create') }}"><i class="me-1" data-feather="plus-square"></i><span class="align-middle">Create</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section id="multiple-column-form">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Branch</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ Form::open(['route' => ['admin.branch.update', $data->id], 'method' => 'POST', 'class' => 'invoice-repeater' ]) }}
                                            @csrf
                                            @method('PUT')
                                            @include('admin.branch.form')
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            <!-- Basic Tables end -->
        </div>
    </div>
</div>
@endsection
