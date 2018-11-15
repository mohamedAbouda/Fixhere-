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
        ({{ $order->user->name }})'s data.
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
        <a href="{{ route('dashboard.admins.edit',$order->id) }}"class="btn btn-warning margin-left-10">
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
                            {{ $order->id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                Client Name
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('dashboard.clients.show', $order->user->id) }}">
                                {{ $order->user->name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="">
                                <span style="margin-left:30px;">
                                    Technician Name
                                </span>
                            </td>
                            <td>
                                {{ $order->agent->name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="">
                                <span style="margin-left:30px;">
                                    Status
                                </span>
                            </td>
                            <td>
                                @if($order->status === 1)
                                Sent but not accepted yet
                                @elseif($order->status === 2)
                                Accepted but not completed
                                @elseif($order->status === 3)
                                Accepted & finished
                                @else
                                Unknown
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="">
                                <span style="margin-left:30px;">
                                    Items
                                </span>
                            </td>
                            <td>
                                @foreach($order->items as $item)
                                <strong>Product : </strong>{{$item->product->name}}<br>
                                <strong>quantity : </strong>{{$item->qty}}<br>
                                <strong>Price per item: </strong>{{$item->price}}<br>
                                <br>
                                <hr>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="">
                                <span style="margin-left:30px;">
                                    Total price
                                </span>
                            </td>
                            <td>
                                {{$order->total_price}}
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @stop