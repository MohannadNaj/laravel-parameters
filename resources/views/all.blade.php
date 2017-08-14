@extends('parameters::shared.parameters-layout')

@php
  $groupedParameters = $parameters->groupBy('category_id');
@endphp

@section('content')
  <parameters ref="all-parameters" :parameters_list='{!! $parameters->toJson(JSON_HEX_APOS) !!}'></parameters>
@endsection

