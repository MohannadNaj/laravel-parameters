@extends('parameters.shared.parameters-layout')

@section('content')
<div class="container">
	  <div class="panel panel-primary">
	  	<div class="panel-heading">
	  		<h3 class="panel-title">Create Parameter</h3>
	  	</div>
	  	<div class="panel-body">
	  		<form action="{{route('parameters.store')}}" class="form-horizontal" method="POST" role="form">
	  			{{csrf_field()}}
			  	<div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
			  		<label class="control-label col-sm-2" for="">Name</label>
			  		<div class="col-sm-4">
			  			<input type="text" class="form-control" name="name" placeholder="parameter_name">
			  			@include('parameters.shared.parameters-input-errors',['input'=> 'name'])
			  		</div>
			  	</div>

			  	<div class="form-group">
			  		<label class="control-label col-sm-2" for="">Label</label>
			  		<div class="col-sm-4">
			  			<input type="text" class="form-control" name="label" placeholder="parameter_label">
			  		</div>
			  	</div>

			  	<div class="form-group">
			  		<label class="control-label col-sm-2" for="">Lang</label>
			  		<div class="col-sm-4">
			  			<input type="text" class="form-control" name="lang" placeholder="parameter_lang">
			  		</div>
			  	</div>

			  	<div class="form-group">
		  			<label class="control-label col-sm-2">
		  				Editable
		  			</label>
	  				<div class="col-sm-4">
	  					<input type="checkbox" value="1" class="" name="editable" placeholder="editable" checked="checked">
	  				</div>
			  	</div>

			  	<div class="form-group">
		  			<label class="control-label col-sm-2">
		  				Type
		  			</label>
		  			<div class="col-sm-4">
				  		<select name="type" id="inputType" class="form-control" required="required">
				  			@foreach($types as $type)
				  				<option value="{{$type}}">{{$type}}</option>
			  				@endforeach
				  		</select>		  				
		  			</div>
			  	</div>

			  	<div class="form-group">
			  		<label class="control-label col-sm-2" for="">Value</label>
			  		<div class="col-sm-4">
			  			<input type="text" class="form-control" name="value" placeholder="parameter_value">
			  		</div>
			  	</div>

			  	<button type="submit" class="col-sm-offset-1 btn btn-primary">Submit</button>
			  </form>
	  	</div>
	  </div>		
</div>
@endsection