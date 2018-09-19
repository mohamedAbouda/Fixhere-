@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Edit Wallet</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => 'dashboard.store.user.wallet.transaction']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Wallet Info.</h3>
    </div>
       <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="value">
               
                User Wallet is  {{$wallet->value}} L.E
            </label>
           
        </div>
      
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="value">
                <span class="text-danger">*</span>
                Value
            </label>
            {{ Form::number('value',old('value'),['id'=>'value','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('value') }}</p>
            you can add wallet transaction by negative (-)
        </div>
      <input type="hidden" name="wallet_id" value="{{$wallet->id}}">
    </div>
  

</div>
<div class="row">
    <div class="col-md-1 col-xs-4">
        <button type="submit" class="btn primary-btn">Add</button>
    </div>
    <div class="col-md-1 col-xs-4">
        <button type="reset" class="btn cancel-btn">Cancel</button>
    </div>
</div>
{{ Form::close() }}
@stop
