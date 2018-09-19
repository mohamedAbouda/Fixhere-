
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
            ({{ $resource->client->name }})'s data.
        </h3>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="row">
            <div class="col-md-4 sort-col col-xs-4">
            </div>
            <div class="col-md-3 contact-edit-col col-xs-4">
            </div>
        </div>
    </div>
  <!--   <div class="col-md-4 col-md-offset-1 text-right col-xs-11">
      <a href="{{ route('dashboard.admins.create') }}"class="btn btn-primary margin-left-10">
          <span>+ </span>Add admin
      </a>
      <a href="{{ route('dashboard.admins.edit',$resource->id) }}"class="btn btn-warning margin-left-10">
          Edit admin
      </a>
  </div> -->
</div>
@stop

@section('content')
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10 contacts-list-view-card pad15">
            <table class="table table-borderless table-responsive" style="">
                <tbody>
                    <tr>
                        <th class="">
                            <span style="margin-left:30px;">
                                Property
                            </span>
                        </th>
                        <th>
                            Value
                        </th>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                ID
                            </span>
                        </td>
                        <td>
                            {{ $resource->id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                               Client Name
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('dashboard.clients.show', $resource->client->id) }}">
                                    {{ $resource->client->name }}
                        </td>
                    </tr>
                       <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                               Technician Name
                            </span>
                        </td>
                        <td>
                            {{ $resource->technician->name }}
                        </td>
                    </tr>

                        <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                             Service
                            </span>
                        </td>
                        <td>
                            {{ $resource->service->name }}
                        </td>
                    </tr>

                        <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                              Region
                            </span>
                        </td>
                        <td>
                            {{ $resource->region->city->name }}
                        </td>
                    </tr>

                        <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                               Description
                            </span>
                        </td>
                        <td>
                            {{ $resource->description }}
                        </td>
                    </tr>

                           <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                               Pickup Date
                            </span>
                        </td>
                        <td>
                            @if($resource->pickup)
                            @foreach($resource->pickup as $pick)
                                 {{$pick->date->format('Y/M/d - H:s')}}<br>
                            @endforeach
                            @else
                            No Pickup date yet.
                            @endif
                        </td>
                    </tr>

                        <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                               Status
                            </span>
                        </td>
                        <td>
                             @if($resource->status === 0)
                                Recieved
                                @elseif($resource->status === 1)
                                Accepted
                                @elseif($resource->status === 2)
                                Technical agent is on the way
                                @elseif($resource->status === 3)
                                Done
                                @endif
                        </td>
                    </tr>

                        <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                              Reviews
                            </span>
                        </td>
                        <td>
                            @if($resource->reviews)
                             <strong>Avg reviews : </strong> {{$resource->reviews->sum('rate') / count($resource->reviews)}}<br>
                             <strong>Total reviews : </strong> {{ count($resource->reviews)}}<br>
                             <hr>
                            @foreach($resource->reviews as $review)
                                 <strong>Rate : </strong> {{$review->rate}}<br>
                                 <strong>Review : </strong>{{$review->review}}<br>
                                 <hr>
                            @endforeach

                            @else
                            No Reviews date yet.
                            @endif
                        </td>
                    </tr>
                 
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
