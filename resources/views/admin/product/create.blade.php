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
                            <h2 class="content-header-title float-start mb-0">Product</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Product</a></li>
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
                                <form class="form" method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Tamil Name</label>
                                                <input type="text" class="form-control  @error('tamil_name') is-invalid @enderror" placeholder="Tamil Name" name="tamil_name" />
                                                @error('tamil_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">English Name</label>
                                                <input type="text" class="form-control  @error('english_name') is-invalid @enderror" placeholder="English Name" name="english_name" />
                                                @error('english_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Slug</label>
                                                {{-- {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug']) }} --}}
                                                <input type="text"  class="form-control @error('slug') is-invalid @enderror" placeholder="Slug" name="slug" />
                                                @error('slug')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Category</label>
                                                <select class="select2 form-select" name="parent_id">
                                                    <option value="">None</option>
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
                                                <label class="form-label" for="select2-basic">Type</label>
                                                <select class="select2 form-select" name="type">
                                                    <option value="1">Small</option>
                                                    <option value="2">Medium</option>
                                                    <option value="3">Large</option>
                                                </select>
                                                @error('type')
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
                                                <label for="formFile" class="form-label">Gross Weigth</label>
                                                <input type="number"  class="form-control @error('grossweight') is-invalid @enderror" placeholder="Gross Weight" name="grossweight" />
                                                @error('grossweight')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label for="formFile" class="form-label">Net Weight</label>
                                                <input type="number"  class="form-control @error('netweight') is-invalid @enderror" placeholder="net Weight" name="netweight" />
                                                @error('netweight')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="formFile" class="form-label">Regular Price</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text" id="basic-addon3">&#8377;</span>
                                                <input type="number" class="form-control" name="regular_price">
                                                @error('regular_price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="formFile" class="form-label">Sale Price</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text" id="basic-addon3">&#8377;</span>
                                                <input type="number" class="form-control" name="sale_price">
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
                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Short Description</label>
                                                <textarea class="form-control tinymce-textarea" name="short_description" rows="4" cols="50">

                                                </textarea>
                                                @error('short_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Long Description</label>
                                                <textarea class="form-control tinymce-textarea" name="long_description" rows="4" cols="50">

                                                </textarea>
                                                @error('long_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <div class="demo-inline-spacing">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input is_stock_available" name="is_stock_available" type="checkbox"  value="1" />
                                                        <label class="form-check-label" >Is Stock Available?</label>
                                                    </div>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="col-md-6 col-12 stock" style="display: none;">
                                            <div class="mb-1">
                                                <label>Stock</label>
                                                <input type="text" class="form-control  @error('stock') is-invalid @enderror" placeholder="Stock" name="stock" />
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <div class="demo-inline-spacing">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name='is_product_customizeable'/>
                                                        <label class="form-check-label" name="is_product_customizeable" >Is Customizable Product?</label>
                                                    </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="row">
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
@push('scripts')
<script>
    $(function(){
        $('.is_stock_available').click(function(){
            if($(this).is(':checked')){
                $('.stock').css('display','block')
            }else{
                $('.stock').css('display','none')
            }
        })
    })
</script>
@endpush
