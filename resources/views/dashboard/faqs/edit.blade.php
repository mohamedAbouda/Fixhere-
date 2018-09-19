@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Edit faq ({{ $resource->name }})</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => ['dashboard.faqs.update' , $resource->id] ,'method' => 'PATCH','files'=>'true']) }}
<input type="hidden" name="resource_id" value="{{ $resource->id }}">
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">FAQ Info.</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="question">
                <span class="text-danger">*</span>
                Question
            </label>
            {{ Form::text('question',$resource->question,['id'=>'question','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('question') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="answer">
                <span class="text-danger">*</span>
                Answer
            </label>
            {{ Form::textarea('answer',$resource->answer,['id'=>'answer','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('answer') }}</p>
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
