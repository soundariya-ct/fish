@if(session()->has('success'))
    Swal.fire({
        title: 'Good job!',
        text: '{{ Session::get('success') }}',
        icon: 'success',
        customClass: {
        confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
    });
@endif


@if(session()->has('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Danger!</strong>  {{ Session::get('danger') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

