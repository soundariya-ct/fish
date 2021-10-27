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
                            <h2 class="content-header-title float-start mb-0">Category</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Category</a></li>
                                    <li class="breadcrumb-item active">Create</li>
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
                                <a class="dropdown-item" href="{{ route('admin.category.index') }}"><i class="me-1" data-feather="arrow-left-circle"></i><span class="align-middle">Back</span></a>
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
                                <form class="form" method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Category Name" name="name" />
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Slug</label>
                                                <input type="text"  class="form-control @error('slug') is-invalid @enderror" placeholder="Slug" name="slug" />
                                                @error('slug')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Parent Category</label>
                                                <select class="select2 form-select" name="parent_id">
                                                    <option value="none">None</option>
                                                    @foreach($category as $key => $cat)
                                                        <option value="{{ $cat->id }}" class="optionGroup">{{ ucFirst($cat->name) }}</option>
                                                            @foreach($cat->getChildrenCategory as $key => $childcat)
                                                                <option value="{{ $childcat->id }}">|--{{ ucFirst($childcat->name) }}</option>
                                                                @include('admin.category.child',['child_category' => $childcat  ])
                                                            @endforeach
                                                    @endforeach
                                                </select>
                                                @error('parent_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label for="formFile" class="form-label">Image</label>
                                                <input class="form-control" type="file" name="image" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Meta Title</label>
                                                <input type="text"  class="form-control @error('meta_title') is-invalid @enderror" placeholder="Meta Title" name="meta_title" />
                                                @error('meta_title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Meta keywords</label>
                                                <input type="text"  class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="Meta keywords" name="meta_keywords" />
                                                @error('meta_keywords')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Meta Description</label>
                                                <input type="text"  class="form-control @error('meta_description') is-invalid @enderror" placeholder="Meta Description" name="meta_description" />
                                                @error('meta_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="select2-basic">Status</label>
                                                <select class="select2 form-select" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">InActive</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                                        </div>
                                    </div>
                                </form>
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

