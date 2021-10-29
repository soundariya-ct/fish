<div class="row">
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Pincode</label>
            {{ Form::text('pincode',   @$pincode_value->pincode, ['class' => 'form-control']) }}
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class=" ">
        <div class="mb-1">
            <label class="form-label">Is Available</label>
            {{  Form::checkbox('is_available', '0',  @$is_available, ['class' => 'custom-control-input '] ) }}
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary me-1">Submit</button>
    </div>
</div>
