@extends('parameters::shared.parameters-layout')

@section('content')
  <pre>{{print_r($parameter->toArray())}}</pre>
@endsection