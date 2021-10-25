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
                                    <li class="breadcrumb-item active">Edit</li>
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


          <!-- Modern Horizontal Wizard -->
            <section class="modern-horizontal-wizard">
                <div class="bs-stepper wizard-modern modern-wizard-example">
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#product-edit" role="tab" id="product-edit-trigger">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="edit-2" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Product Details</span>
                                    <span class="bs-stepper-subtitle">Products Details</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step" data-target="#product-gallery" role="tab" id="product-gallery-trigger">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="image" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Product Gallery</span>
                                    <span class="bs-stepper-subtitle">Add Product Gallery</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step" data-target="#product-attribute" role="tab" id="product-attribute-trigger">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="book" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Product Attribute</span>
                                    <span class="bs-stepper-subtitle">Product Attribute</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="product-edit" class="content" role="tabpanel" aria-labelledby="product-edit-trigger">
                            <div class="row">
                                            <form class="form" method="POST" action="{{ route('admin.product.update',$data->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="_method" value="PATCH">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label">Tamil Name</label>
                                                            <input type="text" class="form-control  @error('tamil_name') is-invalid @enderror" placeholder="Tamil Name" name="tamil_name" value="{{ $data->tamil_name }}" />
                                                            @error('tamil_name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label">English Name</label>
                                                            <input type="text" class="form-control  @error('english_name') is-invalid @enderror" placeholder="English Name" name="english_name" value="{{ $data->english_name }}" />
                                                            @error('english_name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label">Slug</label>
                                                            <input type="text"  class="form-control @error('slug') is-invalid @enderror" placeholder="Slug" name="slug" value="{{ $data->slug }}" />
                                                            @error('slug')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label">Parent Category</label>
                                                            <select class="select2 form-select" name="parent_id">
                                                                <option value="">None</option>
                                                                @foreach($category as $key => $cat)
                                                                <option value="{{ $cat->id }}" class="optionGroup" {{ ($cat->id == $data->parent_id)?'selected':'' }}>{{ ucFirst($cat->name) }}</option>
                                                                    @foreach($cat->getChildrenCategory as $key => $childcat)
                                                                        <option value="{{ $childcat->id }}"  {{ ($childcat->id ==$data->parent_id)?'selected':'' }} >--{{ ucFirst($childcat->name) }}</option>
                                                                        @include('admin.category.child',['child_category' => $childcat,'questionCategory' => $data->parent_id])
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
                                                                <option value="1" {{ ($data->type ==1)?'selected':'' }}>Small</option>
                                                                <option value="2" {{ ($data->type ==2)?'selected':'' }}>Medium</option>
                                                                <option value="3" {{ ($data->type ==3)?'selected':'' }}>Large</option>
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
                                                            @if(!empty($data->image))
                                                                <img src="{{ asset($data->image) }}" style="width:30%;" class="mt-1" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label for="formFile" class="form-label">Gross Weigth</label>
                                                            <input type="number"  class="form-control @error('grossweight') is-invalid @enderror" placeholder="Gross Weight" name="grossweight" value="{{ $data->grossweight }}" />
                                                            @error('grossweight')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label for="formFile" class="form-label">Net Weight</label>
                                                            <input type="number"  class="form-control @error('netweight') is-invalid @enderror" placeholder="net Weight" name="netweight" value="{{ $data->netweight }}" />
                                                            @error('netweight')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <label for="formFile" class="form-label">Regular Price</label>
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-text" id="basic-addon3">&#8377;</span>
                                                            <input type="number" class="form-control" name="regular_price" value="{{ $data->regular_price }}">
                                                            @error('regular_price')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <label for="formFile" class="form-label">Sale Price</label>
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-text" id="basic-addon3">&#8377;</span>
                                                            <input type="number" class="form-control" name="sale_price" value="{{ @$data->sale_price }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label">Meta Title</label>
                                                            <input type="text"  class="form-control @error('meta_title') is-invalid @enderror" placeholder="Meta Title" name="meta_title" value="{{ $data->meta_title }}" />
                                                            @error('meta_title')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label">Meta keywords</label>
                                                            <input type="text"  class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="Meta keywords" name="meta_keywords" value="{{ $data->meta_keywords }}" />
                                                            @error('meta_keywords')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label">Meta Description</label>
                                                            <input type="text"  class="form-control @error('meta_description') is-invalid @enderror" placeholder="Meta Description" name="meta_description" value="{{ $data->meta_description }}" />
                                                            @error('meta_description')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="select2-basic">Status</label>
                                                            <select class="select2 form-select" name="status">
                                                                <option value="1" {{ ($data->status == 1)?'selected':'' }}>Active</option>
                                                                <option value="0" {{ ($data->status == 0)?'selected':'' }}>InActive</option>
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
                                                                {{ @$data->short_description }}
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
                                                                {{ @$data->long_description }}
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
                                                                    <input class="form-check-input is_stock_available" name="is_stock_available" type="checkbox"  value="1"
                                                                     @if($data->is_stock_available == 1) checked="checked"  @endif />
                                                                    <label class="form-check-label" >Is Stock Available?</label>
                                                                </div>
                                                                </div>
                                                            </div>
                                                    </div>

                                                    <div class="col-md-6 col-12 stock" style="display: {{ ($data->is_stock_available == 1)?'block':'' }};">
                                                        <div class="mb-1">
                                                            <label>Stock</label>
                                                            <input type="number" value="{{ $data->stock }}" class="form-control  @error('stock') is-invalid @enderror" placeholder="Stock" name="stock" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="mb-1">
                                                            <div class="demo-inline-spacing">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox"  value="0" />
                                                                    <label class="form-check-label" name="is_customizable_product" >Is Customizable Product?</label>
                                                                </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary me-1">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                        <div id="product-gallery" class="content" role="tabpanel" aria-labelledby="product-gallery-trigger">
                                <form method="POST" action="{{ route('admin.product.uploadGalleryImages') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}" id="product_id" />
                                    <div class="row">
                                        <div class="mb-1 col-md-4">
                                            <label class="form-label" for="modern-first-name">Upload Images</label>
                                            <input type="file" class="form-control"name="images[]" multiple/>
                                        </div>
                                        <div class="mb-1 col-md-6">
                                        <button type="submit" class="btn btn-primary mt-2">Upload</button>
                                        </div>
                                    </div>
                                </form>
                                <section id="ecommerce-products" class="grid-view">
                                    <div class="row">
                                       @if (isset($data->product_gallery) && !$data->product_gallery->isEmpty())
                                            @foreach ($data->product_gallery as $gallery)
                                                <div class="col-3 mt-1">
                                                    <div class="card ecommerce-card">
                                                        <div class="item-img text-center">
                                                            <a href="#l">
                                                                <img class="img-fluid card-img-top" src="{{ asset($gallery->image) }}" alt="img-placeholder"></a>
                                                        </div>
                                                        <div class="item-options text-center mt-1">
                                                            <button data-href="{{ route('admin.product.deleteImage',['product' => $data->id,'gallery' => $gallery->id]) }}" class="btn btn-danger delete-gallery-image">
                                                                <i data-feather="trash" class="font-medium-3"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </section>
                        </div>
                        <div id="product-attribute" class="content" role="tabpanel" aria-labelledby="product-attribute-trigger">
                            <div class="content-header">
                                <h5 class="mb-0">Product Variant</h5>
                                {{ Form::open(['route' => 'admin.product.slices', 'method' => 'POST', 'enctype' => "multipart/form-data", 'class' => 'invoice-repeater' ]) }}
                                    @csrf
                                    <div data-repeater-list='invoice'>
                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemcost">Name</label>
                                                    {{ Form::file('slice_image',  ['class' => 'custom-file-input form-control', 'id' => 'slice_image']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemcost">Name</label>
                                                    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}

                                                </div>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemquantity">Number of Pieces</label>
                                                    {{ Form::number('pieces', null, ['class' => 'form-control', 'id' => 'pieces']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-12 mb-50">
                                                <div class="mb-1">
                                                    <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                        <i data-feather="x" class="me-25"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                            <i data-feather="plus" class="me-25"></i>
                                            <span>Add New</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-icon btn-primary" type="submit">
                                           Submit
                                        </button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- /Modern Horizontal Wizard -->

        </div>
    </div>
<!-- END: Content-->
@endsection
@push('scripts')
    <script>
        // $(document).ready(function(){

        //     $( "#add_new" ).submit(function( event ) {
        //         event.preventDefault();
        //         $this = $(this);

        //         $.ajax({
        //             method:  $this.attr('method'),
        //             url:   $this.attr('action'),
        //             data: $this.serialize(),
        //             success: function (html) {
        //                 $('#VoteContent').html(html);
        //                 $('#poll-container form').append('<input name="_token" type="hidden" value="' + $('meta[name="csrf-token"]').attr('content') + '">');
        //             },
        //             error: function (jqXhr) {
        //                 $('#VoteModal').modal('hide');
        //                 swalError(jqXhr);
        //             }
        //         });

        //     });
            // $( "#add_new" ).click(function( event ) {
            //     event.preventDefault();
            //     var slice_image = $('#slice_image')[0].files;
            //     var name = $('#name').val();
            //     var pieces = $('#pieces').val();
            //     var id = $('#product_id').val();

            //     $.ajax({
            //         method: "GET",
            //         enctype: 'multipart/form-data',
            //         url:  "{{ route('admin.product.slices') }}",
            //         data: {'file' : {slice_image}, 'name' : name, 'pieces' : pieces, 'id' : id},
            //         success: function (html) {
            //             $('#VoteContent').html(html);
            //             $('#poll-container form').append('<input name="_token" type="hidden" value="' + $('meta[name="csrf-token"]').attr('content') + '">');
            //         },
            //         error: function (jqXhr) {
            //             $('#VoteModal').modal('hide');
            //             swalError(jqXhr);
            //         }
            //     });
            // });

        // })
    $(function(){
            @include('admin.layouts.errors')
            $('.is_stock_available').click(function(){
                if($(this).is(':checked')){
                    $('.stock').css('display','block')
                }else{
                    $('.stock').css('display','none')
                }
            })

    })

    $('.delete-gallery-image').click(function(e){
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

