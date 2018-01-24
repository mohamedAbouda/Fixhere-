@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Add agent</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => 'dashboard.agents.store','files'=>'true']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Agent Info.</h3>
    </div>

    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-3">
            <div class="form-group">
                <label class="control-label" for="profile_image">
                    <span class="text-danger">*</span>
                    Profile image :
                </label>
                <div class="clearfix"></div>
                <label for="profile_image">
                    <img src="{{ asset('panel-assets/images/fields/01_picture.png') }}" alt="" class="thumbnail" style="width:215px;height:215px;cursor: pointer; cursor: hand;">
                    <input type="file" name="profile_image" id="profile_image" style="display:none;" onchange="preview(this);">
                </label>
                <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('profile_image') }}</p>
            </div>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
                Name
            </label>
            {{ Form::text('name',old('name'),['id'=>'name','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('name') }}</p>
            @if(isset($centers))
            <label class="control-label" for="parent_id">
                <span class="text-danger">*</span>
                Center
                <span class="text-info" style="font-weight: 200;margin-left:10px;">You must have centers first</span>
            </label>
            {{ Form::select('parent_id',$centers,old('parent_id'),['id'=>'parent_id','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('parent_id') }}</p>
            @endif
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

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
$('select').select2();
function preview(input)
{
    var parent = $(input).parent();
    var preview = parent.find('img');
    var file    = input.files[0];
    var reader  = new FileReader();

    reader.addEventListener("load", function () {
        preview.attr('src',reader.result);
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}
</script>
@stop
@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop
