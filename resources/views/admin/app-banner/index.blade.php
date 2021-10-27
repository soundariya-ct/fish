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

                                            {{ Form::open(['route' => 'admin.app-banner.store', 'method' => 'POST', 'enctype' => "multipart/form-data", 'class' => 'container' ]) }}
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
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            {{ Form::label('product_id', 'Product', ['class' => 'custom-file-label']) }}
                                                            {{ Form::select('product_id', $products ,null, ['class' => 'custom-file-input form-control']) }}
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
                        @if(@!empty($posts))
                            <div class="content-body">
                                <!-- Basic Tables start -->
                                <div class="row" id="basic-table">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Banner</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive table-bordered">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Image</th>
                                                                <th>Link</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($posts as $post)
                                                                <tr>
                                                                    <td>
                                                                        <img src="{{ Storage::url($post->banner_image) }}"   width="10%" alt="" />
                                                                    </td>
                                                                    <td>
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                                            <a href="{{ route('admin.app-banner.edit',$post->id) }} " class="btn btn-primary waves-effect waves-float waves-light"><i data-feather="edit-2" class="me-50"></i></a>
                                                                            <button type="button" class="btn btn-primary waves-effect waves-float waves-light delete" data-href="{{ route('admin.app-banner.edit',$post->id) }} "><i data-feather="trash" class="me-50"></i></button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
   $(function(){
        @include('admin.layouts.errors')
   })

   $('.delete').click(function(e){
    e.preventDefault();
    var url= $(this).data('href');
    Swal.fire({
        title: `Are you sure to delete?`,
        text: "If you delete this, it will be gone forever.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false
      }).then(function (result) {
            if(result.value) {
                if (result.isConfirmed){
                    window.location.href = url;
                }
            }
      });
   })

</script>
@endpush
