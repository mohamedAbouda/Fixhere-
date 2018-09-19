@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Edit City</h3>
    </div>
</div>
@stop
@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
#map {
    height: 400px;
    width: 100%;
}
</style>

@stop
@section('content')
{{ Form::open(['route' => ['dashboard.regions.update',$region->id],'method' => 'PATCH']) }}

<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Region Info.</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
                City
            </label>
            <select class="form-control select" name="city_id" required>
                @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('city_id') }}</p>
        </div>
           <div class="form-group margin-bottom20 col-md-12">
            <div id="map">
            </div>
            <input type="hidden" name="lat" value="{{$region->lat}}">
            <input type="hidden" name="lng" value="{{$region->lng}}">
            <input type="hidden" name="zoom" id="zoom" value="{{$region->zoom}}">
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn2wwrPJu1htS6t-KDmt_K8i8SMX81jfg&callback=initMap">
</script>
<script type="text/javascript">
    $('.select').select2();
   
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
        lat: {{$region->lat}},
        lng: {{$region->lng}}
    };
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: {{$region->zoom}},
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
    google.maps.event.addListener(map, 'zoom_changed', function() {
    zoomLevel = map.getZoom();
    $('#zoom').val(zoomLevel);
});
}
</script>
@endsection
