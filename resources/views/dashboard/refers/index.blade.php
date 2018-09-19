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
            Refers
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
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-5 margin-bottom10 margin-top20">
                <div class="total-customer-col pad5 pad-bottom5 col-md-12">
                    <div class="col-md-9 customer-stat-col-pad">
                        <h5 class="customer-stat-text pad5">Total Refers count</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">
                            {{ count($refers) }}
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
            {{ $refers->links() }}
        </div>
        <div class="row margin-bottom10 contacts-list-view-card pad15">
            <table class="table table-borderless table-responsive" style="margin-bottom:0;">
                <tbody>
                    <tr>
                        <th class="text-center">#</th>
                        <th>
                            Email
                        </th>
                        <th>
                            User 
                        </th>
                        
                        
                    </tr>
                    @foreach($refers as $refer)
                    <tr>
                        <td class="text-center">
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{  $loop->iteration }}
                            </h3>
                        </td>
                      
                         <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                              
                                    {{ $refer->email }}
                               
                            </h3>
                        </td>
                         <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                              
                                    {{ $refer->user->name }}
                               
                            </h3>
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
