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
            Enquiries
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
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-5 margin-bottom10 margin-top20">
                <div class="total-customer-col pad5 pad-bottom5 col-md-12">
                    <div class="col-md-9 customer-stat-col-pad">
                        <h5 class="customer-stat-text pad5">Total enquiries count</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">
                            {{ $total_resources_count }}
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
            {{ $resources->links() }}
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
                            With
                        </th>
                        <th></th>
                    </tr>
                    @foreach($resources as $resource)
                    <tr>
                        <td class="text-center">
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $counter_offset + $loop->iteration }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="margin-top10 contact-details-view" style="font-weight: 400;">
                                <span class="{{ $resource->first()->from === Auth::user()->id ? 'text-success' : 'text-info' }}">{{ $resource->first()->message }}</span>
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                <?php if ($resource->first()->from === Auth::user()->id): ?>
                                    {{ $resource->first()->toUser->name }}
                                <?php else: ?>
                                    {{ $resource->first()->fromUser->name }}
                                <?php endif; ?>
                            </h3>
                        </td>
                        <td>
                            <div class="no-shadow btn-group pull-right" style="margin:0;padding:0;">
                                <a href="{{ route('dashboard.enquiries.show',$resource->first()->group) }}" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle contact-edit-dots-shdw pad0">
                                    <i class="fa fa-reply"></i>
                                </a>
                                <button type="button" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle contact-edit-dots-shdw pad0" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-h fa-lg edit-btn-contact-ico-color"></i>
                                </button>
                                <ul class="dropdown-menu contact-dropdown pull-right">
                                    <li>
                                        {{ Form::open(['route' => ['dashboard.enquiries.destroy' ,$resource->first()->id] ,'method' => 'DELETE']) }}
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
