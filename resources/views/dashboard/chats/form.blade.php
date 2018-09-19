@extends('layouts.dashboard.app')

@section('stylesheets')
<style>
body {
    background-color:#edeff9;
}
</style>
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">
            Chat messages
        </h3>
    </div>
</div>
@stop

@section('content')
<div class="row margin-top15">
    @foreach($order->chatMessages()->with('sender')->get() as $chat_message)
    <?php
    switch ($chat_message->sender_type) {
        case \App\Chat::SENDER_TYPE_ADMIN:
        $style = 'alert-success pull-right';
        $dir = 'rtl';
        break;
        case \App\Chat::SENDER_TYPE_CLIENT:
        $style = 'alert-warning pull-left';
        $dir = 'ltr';
        break;
        case \App\Chat::SENDER_TYPE_AGENT:
        $style = 'alert-info pull-left';
        $dir = 'ltr';
        break;
    }
    ?>
    <div class="alert {{ $style }} col-md-10" role="alert" style="direction: {{ $dir }};">
        <span {!! $dir == 'rtl' ? 'class="pull-right" style="margin-left:10px;"' : 'style="margin-right:10px;"' !!}>
            <strong>
                {{ ($chat_message->sender ? $chat_message->sender->name : '[DELETED]') . '  (' . $chat_message->sender_type . ')' }}
            </strong>
        </span>
        {{ $chat_message->message }}
        <span class="{{ $dir == 'rtl' ? 'pull-left' : 'pull-right' }}">
            <strong>
                {{ $chat_message->createdAtFriendlyFormat }}
            </strong>
        </span>
    </div>
    <div class="clearfix"></div>
    @endforeach
</div>
{{ Form::open(['route' => ['dashboard.chats.send' ,$order->id]]) }}
<div class="row margin-top15">
    <div class="input-group">
        <input type="text" name="message" class="form-control" required>
        <span class="input-group-btn">
            <button class="btn btn-primary" type="submit" style="height:100%;">
                <i class="fa fa-reply"></i>
            </button>
        </span>
    </div>
</div>
{{ Form::close() }}
@stop
