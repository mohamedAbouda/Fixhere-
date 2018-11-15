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
            Orders
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
   <!--  <div class="col-md-4 col-md-offset-1 text-right col-xs-11">
       <a href="{{ route('dashboard.orders.create') }}"class="btn btn-blue margin-left-10">
           <span>+ </span>Add order
       </a>
   </div> -->
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-5 margin-bottom10 margin-top20">
                <div class="total-customer-col pad5 pad-bottom5 col-md-12">
                    <div class="col-md-9 customer-stat-col-pad">
                        <h5 class="customer-stat-text pad5">Total orders count</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">
                            {{ count($orders) }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10">
            {{ $orders->links() }}
        </div>
        <div class="row margin-bottom10 contacts-list-view-card pad15">
            <table class="table table-borderless table-responsive" style="margin-bottom:0;">
                <tbody>
                    <tr>
                        <th class="text-center">#</th>
                        <th>
                            Client
                        </th>
                        <th>
                            Technical agent
                        </th>
                     
                        <th>
                            Status
                        </th>
                        <th></th>
                    </tr>
                    @foreach($orders as $resource)
                    <tr>
                        <td class="text-center">
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $loop->iteration }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                @if($resource->user)
                                <a href="{{ route('dashboard.clients.show', $resource->user->id) }}">
                                    {{ $resource->user->name }}
                                </a>
                                @else
                                <span class="text-danger">[DELETED]</span>
                                @endif
                            </h3>
                        </td>
                   
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                @if($resource->agent)
                                <a href="#">
                                    {{ $resource->agent->name }}
                                </a>
                                @else
                                <span class="text-danger">No Assigened yet</span>
                                @endif
                            </h3>
                        </td>
                  
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                @if($resource->status === 1)
                                Sent but not accepted yet
                                @elseif($resource->status === 2)
                                Accepted but not completed
                                @elseif($resource->status === 3)
                                 Accepted & finished
                                @else
                                Unknown
                                @endif
                            </h3>
                        </td>

                        <td>
                            <div class="no-shadow btn-group pull-right" style="margin:0;padding:0;">
                                <button type="button" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle contact-edit-dots-shdw pad0" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-h fa-lg edit-btn-contact-ico-color"></i>
                                </button>
                                <ul class="dropdown-menu contact-dropdown pull-right">
                                    <li>
                                        <a href="{{ route('dashboard.orders.show', $resource->id) }}">Show</a>
                                    </li>
                                    <li>
                                        {{ Form::open(['route' => ['dashboard.orders.destroy' ,$resource->id] ,'method' => 'DELETE']) }}
                                        <button type="submit">Delete</button>
                                        {{ Form::close() }}
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script>

</script>
@stop
