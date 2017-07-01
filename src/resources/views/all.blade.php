@extends('parameters::shared.parameters-layout')

@section('content')
  	<div class="row" id="app">
  		<div class="col-sm-3">
  			<div class="list-group">
  				@foreach ($parameters->groupBy('category_id') as $category_id => $category)
	  				<a href="#" class="list-group-item">{{param()->where('id', $category_id)->last()['value']}}</a>
  				@endforeach
  			</div>
  		</div>
  		<div class="col-sm-9">
  			<parameters></parameters>
  		</div>
  	</div>
@endsection