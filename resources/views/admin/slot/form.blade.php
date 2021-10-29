<div class="row">
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Deliver Type</label>
            {{ Form::select('delivery_type', ['F' => 'fast_delivery', 'D' => 'door_delivery'],  @$slot->delivery_type, ['class' => 'form-control']) }}
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">Day Type</label>
            {{ Form::select('day_type', ['M' => 'morning', 'E' => 'evening'],  @$slot->day_type, ['class' => 'form-control']) }}
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label for="formFile" class="form-label">Start Time</label>
            {{ Form::datetimeLocal('start_time', (isset($slot)) ? Carbon\Carbon::parse($slot->start_time)->format('d-m-Y H:i')  : null,  ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mb-1">
            <label class="form-label">End Time</label>
            {{ Form::datetimeLocal('end_time',  (isset($slot)) ? $slot->end_time : null, ['class' => 'form-control']) }}
            @error('meta_title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary me-1">Submit</button>
    </div>
</div>
