@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Add Promo Code</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => 'dashboard.promo_codes.store']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Promo Code Info.</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
                Value
            </label>
            {{ Form::text('value',old('value'),['id'=>'value','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('value') }}</p>
            if value < 1 it will percentage , if value > 1 it will be amount<br>
            the code will be auto generated and you can edit it later
        </div>
          <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
               Is Valid ?
            </label>
            <select class="form-control" name="is_valid">
                <option selected disabled>Select Status</option>
                <option value="1">Valid</option>
                <option value="0">Not Valid</option>
            </select>
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('is_valid') }}</p>
        </div>
      
    </div>
  

</div>
<div class="row">
    <div class="col-md-1 col-xs-4">
        <button type="submit" class="btn primary-btn">Save</button>
    </div>
    <div class="col-md-1 col-xs-4">
        <button type="reset" class="btn cancel-btn">Cancel</button>
    </div>
</div>
{{ Form::close() }}
@stop
