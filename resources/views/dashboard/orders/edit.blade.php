@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Edit order</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => ['dashboard.orders.update' , $resource->id] ,'method' => 'PATCH']) }}
<input type="hidden" name="resource_id" value="{{ $resource->id }}">
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Order Info.</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="service_type">
                <span class="text-danger">*</span>
                Service type
            </label>
            {{ Form::text('service_type',$resource->service_type,['id'=>'service_type','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('service_type') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="order_date">
                <span class="text-danger">*</span>
                Date
            </label>
            {{ Form::text('order_date',$resource->order_date,['id'=>'order_date','required'=>'required','class' => 'form-control' ,'placeholder' => 'YYYY-MM-DD']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('order_date') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="time_from">
                <span class="text-danger">*</span>
                Time from
            </label>
            {{ Form::text('time_from',$resource->time_from,['id'=>'time_from','required'=>'required','class' => 'form-control','placeholder' => 'HH:mm']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('time_from') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="time_to">
                <span class="text-danger">*</span>
                Time to
            </label>
            {{ Form::text('time_to',$resource->time_to,['id'=>'time_to','required'=>'required','class' => 'form-control','placeholder' => 'HH:mm']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('time_to') }}</p>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="client_id">
                <span class="text-danger">*</span>
                Client
                <span class="text-info" style="font-weight: 200;margin-left:10px;">You must have clients first</span>
            </label>
            {{ Form::select('client_id',$clients,$resource->client_id,['id'=>'client_id','required'=>'required','class' => 'form-control','placeholder'=>'Select client']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('client_id') }}</p>
        </div>
        @if(isset($centers))
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="center_id">
                <span class="text-danger">*</span>
                Center
                <span class="text-info" style="font-weight: 200;margin-left:10px;">You must have centers first</span>
            </label>
            {{ Form::select('center_id',$centers,$resource->center_id,['id'=>'center_id','required'=>'required','class' => 'form-control','placeholder'=>'Select center']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('center_id') }}</p>
        </div>
        @endif
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="agent_id">
                <span class="text-danger">*</span>
                Agent
                <span class="text-info" style="font-weight: 200;margin-left:10px;">You must have technical agents first</span>
            </label>
            <select class="form-control" name="agent_id" id="agent_id">
                <option value="">Select agent</option>
                <?php $agent_option_style = isset($centers) ? 'display:none;' : ''; ?>
                @foreach($agents as $agent)
                <option {{ $resource->agent_id === $agent->id ? 'selected' : 'style="'.$agent_option_style.'"'}} value="{{ $agent->id }}" data-parent-id="{{ $agent->parent_id }}">{{ $agent->name }}</option>
                @endforeach
            </select>
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('agent_id') }}</p>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="problem">
                Problem
            </label>
            {{ Form::textarea('problem',$resource->problem,['id'=>'problem','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('problem') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <div id="map">
            </div>
            <input type="hidden" name="lat" value="{{ $resource->lat }}">
            <input type="hidden" name="lng" value="{{ $resource->lng }}">
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
$(document).ready(function(){
    $('select').not('select[name=agent_id]').select2();
    $('select[name=center_id]').change(function(){
        var value = $(this).val();
        $('select[name=agent_id]').find('option').hide();
        $('select[name=agent_id]').find("option[data-parent-id='" + value + "']").show();
        $('select[name=agent_id]').val('');
    });
});
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn2wwrPJu1htS6t-KDmt_K8i8SMX81jfg &callback=initMap">
</script>

<script type="text/javascript">
var map;
var markers = [];

function addMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
    markers.push(marker);
}
// Sets the map on all markers in the array.
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}
function clearMarkers() {
    setMapOnAll(null);
}
// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearMarkers();
    markers = [];
}

function initMap() {
    var uluru = {
        lat: {{ $resource->lat }},
        lng: {{ $resource->lng }}
    };
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: uluru
    });
    addMarker(uluru);
    google.maps.event.addListener(map, 'click', function( event ){
        var point = {lat: event.latLng.lat(), lng: event.latLng.lng()};
        clearMarkers();
        addMarker(point);
        $('input[name=lat]').val(event.latLng.lat());
        $('input[name=lng]').val(event.latLng.lng());
        console.log("lat: "+event.latLng.lat()+" "+", lng: "+event.latLng.lng());
    });
}
</script>
@stop

@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style media="screen">
#map {
    height: 400px;
    width: 100%;
}
</style>
@stop
