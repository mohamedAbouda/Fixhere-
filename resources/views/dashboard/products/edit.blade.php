@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Edit model</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => ['dashboard.models.update', $resource->id], 'files' => 'true', 'method' => 'PATCH']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Model Info.</h3>
    </div>

    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
                Name
            </label>
            {{ Form::text('name', $resource->name, ['id'=>'name', 'required'=>'required', 'class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('name') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="brand_id">
                <span class="text-danger">*</span>
                Brand
            </label>
            {{ Form::select('brand_id', $brands, $resource->brand_id, ['id'=>'brand_id', 'required'=>'required', 'class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('brand_id') }}</p>
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
