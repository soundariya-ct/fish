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
                                    <h2 class="content-header-title float-start mb-0">App Banner</h2>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section id="multiple-column-form">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Category</h4>
                                        </div>
                                        <div class="card-body">
                                            {{ Form::model(['route' => [ "admin.app-banner.update", $id],'method' => 'PUT', 'class' => 'form-horizontal']) }}
                                            @csrf
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            {{ Form::label('banner_image', 'Banner Image', ['class' => 'custom-file-label']) }}
                                                            {{ Form::file('banner_image', ['class' => 'custom-file-input form-control']) }}
                                                            @error('tamil_name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                    </div>
                                                </div>
                                            {{ Form::close() }}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 
