@extends('admin.layouts.master')
@section('content')

<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Category</h4>
                </div>
                <div class="card-body">
                    {{ Form::open(['route' => 'admin.store_appbanner', 'method' => 'POST', 'enctype' => "multipart/form-data", 'class' => 'container' ]) }}
                    {{-- <form class="form" method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data"> --}}
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
@endsection
