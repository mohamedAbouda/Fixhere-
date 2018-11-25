@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Add About</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => ['dashboard.about.update',$about->id],'method' => 'PATCH']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">About Info.</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="editor">
                <span class="text-danger">*</span>
                About
            </label>
            {{ Form::textarea('about_us',$about->about_us,['id'=>'editor','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('about_us') }}</p>
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
<script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>
<script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );
        </script>
@endsection
