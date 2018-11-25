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
		About
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
		@if(!$about)
		<a href="{{ route('dashboard.about.create') }}"class="btn btn-blue margin-left-10">
			<span>+ </span>Add About
		</a>
		@else
		<a href="{{ route('dashboard.about.edit',$about->id) }}"class="btn btn-blue margin-left-10">
			<span> </span>Edit About
		</a>
		@endif
	</div>
</div>
@stop
@section('content')
<div class="row margin-top15">
	<div class="col-md-12">
		<div class="row margin-bottom10">
		</div>
		@if(isset($about))
		<div class="row margin-bottom10 contacts-list-view-card pad15">
			{!! $about->about_us !!}
		</div>
		@endif
	</div>
</div>
@stop
@section('scripts')
<script>
</script>
@stop