@extends('parameters::shared.parameters-layout')

@php
  $groupedParameters = $parameters->groupBy('category_id');
@endphp

@section('content')
  	<div class="row" id="app">
  		<div class="col-sm-3">
  			<div class="list-group">
  				@foreach ($groupedParameters as $category_id => $category)
            <parameters-category
            title="{{param()->where('id', $category_id)->last()['value']}}"
            target="{{$category_id}}"
            ref="{{$category_id}}_parameter_category"
            :parameters='{!! $category->toJson(JSON_HEX_APOS) !!}'></parameters-category>
          @endforeach
        </div>
      </div>
      <div class="col-sm-9">
  			<parameters ref="parameters"></parameters>
  		</div>
  	</div>
@endsection