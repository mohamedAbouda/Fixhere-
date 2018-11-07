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
        ({{ $promo_code->code }})'s data.
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
    <div class="col-md-4 col-md-offset-1 text-right col-xs-11">
        <a href="{{ route('dashboard.promo_codes.create') }}"class="btn btn-primary margin-left-10">
            <span>+ </span>Add Promo Code
        </a>
        <a href="{{ route('dashboard.promo_codes.edit',$promo_code->id) }}"class="btn btn-warning margin-left-10">
            Edit Promo Code
        </a>
    </div>
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
                            {{ $promo_code->id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                Value
                            </span>
                        </td>
                        <td>
                            {{ $promo_code->value }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                Discount Type
                            </span>
                        </td>
                        <td>
                            @if($promo_code->discount_type == 1)
                            Percentage
                            @else
                            Flat Amount
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                Description
                            </span>
                        </td>
                        <td>
                            {{ $promo_code->description }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                Start Date
                            </span>
                        </td>
                        <td>
                            {{ $promo_code->start_date->format('Y-M-d') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                End Date
                            </span>
                        </td>
                        <td>
                            {{ $promo_code->end_date->format('Y-M-d') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                Is Valid ?
                            </span>
                        </td>
                        <td>
                            @if($promo_code->is_valid == 1)
                            Yes
                            @else
                            No
                            @endif
                        </td>
                    </tr>
                        <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                               NO. of usage
                            </span>
                        </td>
                        <td>
                            {{ $promo_code->number_of_usage }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop