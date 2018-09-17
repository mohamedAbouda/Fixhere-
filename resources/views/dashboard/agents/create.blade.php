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
        <div class="form-group margin-bottom20 col-md-9">
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
            <label class="control-label" for="email">
                <span class="text-danger">*</span>
                Email
            </label>
            {{ Form::email('email',old('email'),['id'=>'email','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('email') }}</p>
        </div>
        <div class="clearfix"></div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="password">
                <span class="text-danger">*</span>
                Password
            </label>
            {{ Form::password('password' ,['id'=>'password','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('password') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="password_confirmation">
                <span class="text-danger">*</span>
                Password-confirmation
            </label>
            {{ Form::password('password_confirmation' ,['id'=>'password_confirmation','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('password_confirmation') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="address">
                Address
            </label>
            {{ Form::text('location',old('location'),['id'=>'address','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('location') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="contact_number">
                Contact number
            </label>
            {{ Form::text('contact_number',old('contact_number'),['id'=>'contact_number','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('contact_number') }}</p>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div id="map" data-lat="30.1197986" data-lng="31.5370003">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" readonly class="form-control" name="lat" id="lat" style="color:#1f2626" value="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" readonly class="form-control" name="lng" id="lng" style="color:#1f2626" value="">
            </div>
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ ENV('MAPS_API_KEY') }}&callback=initMap"></script>
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

var marker ,latlng = undefined;
function initMap() {
    var myLatlng = {
        lat: parseFloat($('#map').attr('data-lat')),
        lng: parseFloat($('#map').attr('data-lng'))
    };

    var map = new google.maps.Map($('#map')[0], {
        zoom: 11,
        center: myLatlng
    });

    if ($('#lat').val() && $('#lng').val()) {
        latlng = {lat: parseFloat($('#lat').val()), lng: parseFloat($('#lng').val())};
        marker = new google.maps.Marker({
            position: latlng,
            map: map
        });
        map.panTo(marker.getPosition());
    }

    google.maps.event.addListener(map, 'click', function( event ){
        latlng = {lat: event.latLng.lat(), lng: event.latLng.lng()};

        $('#lat').val(event.latLng.lat());
        $('#lng').val(event.latLng.lng());

        if (marker) {
            marker.setMap(null);
        }

        marker = new google.maps.Marker({
            position: latlng,
            map: map
        });
        map.panTo(marker.getPosition());
    });
}

$(document).ready(function() {
    $('button[type=reset]').click(function(){
        $('#lat').val('');
        $('#lng').val('');
        if (marker) {
            marker.setMap(null);
        }
    });
});
</script>
@stop

@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop
