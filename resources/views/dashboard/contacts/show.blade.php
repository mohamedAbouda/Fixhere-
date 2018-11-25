
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
            ({{ $contact->name }})'s data.
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
                            {{ $contact->id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                Name
                            </span>
                        </td>
                        <td>
                            {{ $contact->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                Email
                            </span>
                        </td>
                        <td>
                            {{ $contact->email }}
                        </td>
                    </tr>
                       <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                Title
                            </span>
                        </td>
                        <td>
                            {{ $contact->title }}
                        </td>
                    </tr>
                       <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                Message
                            </span>
                        </td>
                        <td>
                            {{ $contact->message }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
