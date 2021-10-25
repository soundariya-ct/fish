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
                        <h2 class="content-header-title float-start mb-0">Product</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Product
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
                            <a class="dropdown-item" href="{{ route('admin.product.create') }}"><i class="me-1" data-feather="plus-square"></i><span class="align-middle">Create</span></a>
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
                    <h4 class="card-title">Product</h4>
                </div>
                <div class="card-body">
                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tamil Name</th>
                                        <th>English Name</th>
                                        <th>Slug</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$products->isEmpty())
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>
                                                    <span class="fw-bold">{{ $product->tamil_name }}</span>
                                                </td>
                                                <td>
                                                    <span class="fw-bold">{{ $product->english_name }}</span>
                                                </td>
                                                <td>{{ $product->slug }}</td>
                                                <td>
                                                    <span class="fw-bold">{{ $product->category_name }}</span>
                                                </td>
                                                <td>
                                                    {!! $product->status_text !!}
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('admin.product.edit',$product->id) }}" class="btn btn-primary waves-effect waves-float waves-light"><i data-feather="edit-2" class="me-50"></i></a>
                                                        <button type="button" class="btn btn-primary waves-effect waves-float waves-light delete" data-href="{{ route('admin.product.delete',$product->id) }}"><i data-feather="trash" class="me-50"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                            <tr>
                                                <td colspan="6"><center>No Product Found (S)</center></td>
                                            </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mx-0 row mt-1">
                            <div class="col-sm-12 col-md-6">
                                Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
                            </div>
                            <div class="col-sm-12 col-md-6 col-auto">
                                {{ $products->links('vendor.pagination.custom') }}
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
@endsection
@section('javascript')
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
@endsection
