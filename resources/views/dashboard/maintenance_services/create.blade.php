@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Add maintenance service</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => 'dashboard.maintenance-services.store', 'files'=>'true']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Maintenance service Info.</h3>
    </div>

    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
                Name
            </label>
            {{ Form::text('name', old('name'), ['id'=>'name', 'required'=>'required', 'class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('name') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="tech_fee">
                <span class="text-danger">*</span>
                Technician fee
            </label>
            {{ Form::number('tech_fee', old('tech_fee', 0), ['id'=>'tech_fee', 'min' => 0, 'step' => 0.25, 'required'=>'required', 'class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('tech_fee') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="brand_id">
                <span class="text-danger">*</span>
                Brand
            </label>
            {{ Form::select('brand_id', $brands, old('brand_id'), ['id'=>'brand_id', 'required'=>'required', 'class' => 'form-control', 'placeholder' => 'select a brand']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('brand_id') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="model_id">
                <span class="text-danger">*</span>
                Model
            </label>
            <select class="form-control" name="model_id" id="model_id" required>
                <option> Select a model </option>
                <?php foreach ($models as $model): ?>
                    <option value="{{ $model->id }}" data-brand-id="{{ $model->brand_id }}" style="display:none;">
                        {{ $model->name }}
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('model_id') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label">
                <span class="text-danger">*</span>
                Type
            </label>
            <div class="clearfix"></div>
            <label>
                <input type="checkbox" name="is_android_part" id="is_android_part" class="iCheck" value='1'>
                Android part
            </label>
            <div class="clearfix"></div>
            <label>
                <input type="checkbox" name="is_ios_part" id="is_ios_part" class="iCheck" value='1'>
                iPhone part
            </label>
            <div class="clearfix"></div>
            <label>
                <input type="checkbox" name="is_delivery_part" id="is_delivery_part" class="iCheck" value='1'>
                Delivery part
            </label>
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('stock') }}</p>
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

@section('stylesheets')
{{ Html::style('panel-assets/plugins/icheck-1/skins/square/blue.css') }}
@stop

@section('scripts')
{{ Html::script('panel-assets/plugins/icheck-1/icheck.min.js') }}
<script type="text/javascript">
$(document).ready(function(){
    $('.iCheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
    });
    $('#brand_id').change(function(){
        let brand_id = $(this).val();
        $('#model_id').find(`option:not(:first)`).hide();
        $('#model_id').find(`option[data-brand-id='${brand_id}']`).show();
        $("#model_id").val($("#model_id option:first").val());
    });
});
</script>
@stop
