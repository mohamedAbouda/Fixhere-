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
            Chats
        </h3>
    </div>
</div>
@stop

@section('content')
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10">
            {{ $chats->links() }}
        </div>
        <div class="row margin-bottom10 contacts-list-view-card pad15">
            <table class="table table-borderless table-responsive" style="margin-bottom:0;">
                <tbody>
                    <tr>
                        <th class="text-center">#</th>
                        <th>
                            Message
                        </th>
                        <th>
                            Order description
                        </th>
                        <th>
                            Sender type
                        </th>
                        <th>
                            Sent at
                        </th>
                        <th></th>
                    </tr>
                    @foreach($chats as $resource)
                    <tr>
                        <td class="text-center">
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $counter_offset + $loop->iteration }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->message }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->order ? $resource->order->description : '' }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->sender_type }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->createdAtFriendlyFormat }}
                            </h3>
                        </td>

                        <td style="padding:0px">
                            <a href="{{ route('dashboard.chats.show' ,$resource->order_id) }}" class="btn btn-default" style="margin:0px">
                                <i class="fa fa-reply"></i>
                            </a>
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
