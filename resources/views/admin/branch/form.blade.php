<div class="row">
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Branch Name</label>
            {{ Form::text('branch_name', (@!empty($data)) ? $data->branch_name : null, ['class' => 'form-control']) }}
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Branch Code</label>
            {{ Form::number('branch_code', (@!empty($data)) ? $data->branch_code : null, ['class' => 'form-control']) }}
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label for="formFile" class="form-label">Country</label>
            {{ Form::text('country', (@!empty($data)) ? $data->country : null, ['class' => 'form-control']) }}

        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">State</label>
            {{ Form::text('state', (@!empty($data)) ? $data->state : null, ['class' => 'form-control']) }}
            @error('meta_title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">City</label>
            {{ Form::text('city', (@!empty($data)) ? $data->city : null, ['class' => 'form-control']) }}
            @error('meta_keywords')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Phone</label>
            {{ Form::number('phone', (@!empty($data)) ? $data->phone : null, ['class' => 'form-control']) }}
            @error('meta_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Latitude</label>
            {{ Form::number('long', (@!empty($data)) ? $data->long : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Longtitude</label>
            {{ Form::number('lat', (@!empty($data)) ? $data->lat : null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Address</label>
            {{ Form::textarea('address',  (@!empty($data)) ? $data->address : null, ['class' => 'form-control']) }}
            @error('meta_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary me-1">Submit</button>
    </div>
</div>

