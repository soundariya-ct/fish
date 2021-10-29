<div class="row">
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Branch Name</label>
            {{ Form::text('branch_name', (@!empty($branch)) ? $branch->branch_name : null, ['class' => 'form-control']) }}
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Branch Code</label>
            {{ Form::number('branch_code', (@!empty($branch)) ? $branch->branch_code : null, ['class' => 'form-control']) }}
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label for="formFile" class="form-label">Country</label>
            {{ Form::select('country_id', $country,  @$country_name, ['class' => 'form-control', 'id' => 'country-dropdown']) }}
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">State</label>
            {{ Form::select('state_id',  @$state ? @$state : [],  @$state_name, ['class' => 'form-control', 'id' => 'state-dropdown']) }}
            @error('meta_title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">City</label>
            {{ Form::select('city_id', @$city ? @$city : [],  @$city_name, ['class' => 'form-control', 'id' => 'city-dropdown']) }}
            @error('meta_keywords')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Phone</label>
            {{ Form::number('phone', (@!empty($branch)) ? $branch->phone : null, ['class' => 'form-control']) }}
            @error('meta_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Latitude</label>
            {{ Form::number('long', (@!empty($branch)) ? $branch->long : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Longtitude</label>
            {{ Form::number('lat', (@!empty($branch)) ? $branch->lat : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Address</label>
            {{ Form::textarea('address',  (@!empty($branch)) ? $branch->address : null, ['class' => 'form-control']) }}
            @error('meta_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary me-1">Submit</button>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#country-dropdown').on('click', function() {
                var country_id = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url:"{{ route('admin.branch.getState') }}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType : 'json',
                    success: function(result){
                        $('#state-dropdown').html('<option value="">Select State</option>');
                        $.each(result.states,function(key,value){
                            $("#state-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $('#city-dropdown').html('<option value="">Select State First</option>');
                    }
                });
            });
            $('#state-dropdown').on('change', function() {
                var state_id = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url:"{{ route('admin.branch.getCity') }}",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType : 'json',
                    success: function(result){
                        $('#city-dropdown').html('<option value="">Select City</option>');
                        $.each(result.cities,function(key,value){
                            $("#city-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                });
            });
        });
    </script>
@endpush
