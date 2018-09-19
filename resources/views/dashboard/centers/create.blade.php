@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Add center</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => 'dashboard.centers.store','files'=>'true']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Center Info.</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <div class="form-group">
                <label class="control-label" for="cover_image">
                    <span class="text-danger">*</span>
                    Cover image :
                </label>
                <div class="clearfix"></div>
                <label for="cover_image">
                    <img src="{{ asset('panel-assets/images/fields/01_picture.png') }}" alt="" class="thumbnail" style="width:215px;height:215px;cursor: pointer; cursor: hand;">
                    <input type="file" name="cover_image" id="cover_image" style="display:none;" onchange="preview(this);">
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
                Name
            </label>
            {{ Form::text('name',old('name'),['id'=>'name','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('name') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="email">
                <span class="text-danger">*</span>
                Email
            </label>
            {{ Form::email('email',old('email'),['id'=>'email','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('email') }}</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="password">
                <span class="text-danger">*</span>
                Password
            </label>
            {{ Form::password('password',['id'=>'password','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('password') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="password_confirmation">
                <span class="text-danger">*</span>
                Confirm password
            </label>
            {{ Form::password('password_confirmation',['id'=>'password_confirmation','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('password_confirmation') }}</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="contact_number">
                <span class="text-danger">*</span>
                Contact number
            </label>
            {{ Form::text('contact_number',old('contact_number'),['id'=>'contact_number','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('contact_number') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="location">
                <span class="text-danger">*</span>
                Address
            </label>
            {{ Form::text('location',old('location'),['id'=>'location','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('location') }}</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="cost_per_hour">
                Cost per hour
            </label>
            {{ Form::number('cost_per_hour',old('cost_per_hour'),['id'=>'cost_per_hour','min' => 0 , 'step' => 0.1,'required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('cost_per_hour') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="description">
                Description
            </label>
            {{ Form::textarea('description',old('description'),['id'=>'description','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('description') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <div id="map">
            </div>
            <input type="hidden" name="lat" value="30.0621627">
            <input type="hidden" name="lng" value="31.2941699">
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
<script type="text/javascript">
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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn2wwrPJu1htS6t-KDmt_K8i8SMX81jfg&callback=initMap">
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
        lat: 30.0621627,
        lng: 31.2941699
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
<style media="screen">
#map {
    height: 400px;
    width: 100%;
}
</style>
@stop
