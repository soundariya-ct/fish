@extends('admin.layouts.master')
@section('content')
<!-- BEGIN: Content-->
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
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('admin.product.index') }}"><i class="me-1" data-feather="arrow-left-circle"></i><span class="align-middle">Back</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic multiple Column Form section start -->
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



                <div class="content-body">
                    <!-- Basic Tables start -->
                    <div class="row" id="basic-table">
                       <div class="col-12">
                           <div class="card">
                               <div class="card-header">
                                   <h4 class="card-title">Category</h4>
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
                                                @if(@!empty($posts))
                                                @foreach ($posts as $post)
                                                           <tr>
                                                               <td>
                                                                <img src="{{ Storage::url($post->banner_image) }}"   width="10%" alt="" />
                                                               </td>

                                                               <td>

                                                               </td>

                                                               <td>
                                                                   <div class="btn-group" role="group" aria-label="Basic example">
                                                                       <a href=" " class="btn btn-primary waves-effect waves-float waves-light"><i data-feather="edit-2" class="me-50"></i></a>
                                                                       <button type="button" class="btn btn-primary waves-effect waves-float waves-light delete" data-href=" "><i data-feather="trash" class="me-50"></i></button>
                                                                   </div>
                                                               </td>
                                                           </tr>
                                                       @endforeach
                                                   @endif
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


                    <section id="multiple-column-form">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

            <!-- Basic Floating Label Form section end -->
        </div>
    </div>
<!-- END: Content-->
@endsection
@push('scripts')

@endpush
