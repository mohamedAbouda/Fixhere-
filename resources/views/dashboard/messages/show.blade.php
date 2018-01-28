@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Messages</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => 'dashboard.clients.store','files'=>'true']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Messages with "someone"</h3>
    </div>

    <div class="col-md-12">
        <p class="text-center">
            <a href="{{ route('dashboard.enquiries.show',$group) . '?page=' . ($index + 1) }}" class="text-info">
                load more
            </a>
        </p>
        @foreach ($messages as $message)
        <?php if (Auth::user()->id === $message->from): ?>
            <div class="alert alert-block alert-success pull-right text-right" style="display: inline-block;">
                {{ $message->message }}
                <p style="font-weight:100;margin-top:5px;">{{ $message->created_at }}</p>
            </div>
            <div class="clearfix"></div>
        <?php else: ?>
            <div class="alert alert-block alert-info pull-left" style="display: inline-block;">
                {{ $message->message }}
                <p style="font-weight:100;margin-top:5px;">{{ $message->created_at }}</p>
            </div>
            <div class="clearfix"></div>
        <?php endif; ?>
        @endforeach
        <?php if ($index > 1): ?>
            <p class="text-center">
                <a href="{{ route('dashboard.enquiries.show',$group) . '?page=1' }}" class="text-info">
                    load less
                </a>
            </p>
        <?php endif; ?>
    </div>

    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            {{ Form::textarea('message',old('message'),['id'=>'message','required'=>'required','class' => 'form-control','rows' => 3 , 'style' => 'resize: none;']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('message') }}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-xs-4">
        <button type="submit" class="btn primary-btn">send</button>
    </div>
</div>
{{ Form::close() }}
@stop
