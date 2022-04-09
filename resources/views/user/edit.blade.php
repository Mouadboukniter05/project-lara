@extends('layout')

@section('content')


<form action="{{ route('user.update', [ 'id' => $user->id ] ) }}" method="POST">
    {{ csrf_field() }}


    <div class="col-md-8">

    	<div class="form-group">
    		<label> {{ __('messages.Name') }}</label>
			<input type="text" class="form-control"  name="name" value="{{ $user->name }}">
		</div>

    	<div class="form-group">
    		<label>{{ __('messages.Email') }}</label>
			<input type="text" class="form-control"  name="email" value="{{ $user->email }}">
		</div>
		<div class="form-group">
    		<label>{{ __('messages.Phone') }}</label>
			<input type="text" class="form-control"  name="phone" value="{{ $user->phone }}">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="{{ __('messages.Password') }}" name="password">
		</div>

	</div>

	<div class="col-md-4">

		<div class="form-group">
			
			<label>{{ __('messages.Post') }}</label>
			@if ( Auth::user()->post=='manager' &&  $user->post != 'manager')
				<select name="post" class="form-control">
					@if( $user->post == 'operation' )
					<option value="operation" selected>Operation</option>
					<option value="manager">Management</option>
					<option value="multimedia">Multimedia</option>
					<option value="audit">Audit</option>
					@endif
					@if ($user->post == 'manager')
					<option value="operation" >Operation</option>
					<option value="manager" selected>Management</option>
					<option value="multimedia">Multimedia</option>
					<option value="audit">Audit</option>			  
					@endif
					{{-- @if ($user->post == 'manager'||Auth::user()->post !='super manager')
					<select name="post" class="form-control">
						<option value="{{$user->post}}"selected>You Cant Edit Post</Em></option>
						</select>			  
					@endif --}}
					@if ($user->post == 'multimedia')
					<option value="operation" >Operation</option>
					<option value="manager" >Management</option>
					<option value="multimedia"selected>Multimedia</option>
					<option value="audit">Audit</option>			  
					@endif
					@if ($user->post == 'audit')
					<option value="operation" >Operation</option>
					<option value="manager" >Management</option>
					<option value="multimedia">Multimedia</option>
					<option value="audit"selected>Audit</option>			  
					@endif
				</select>
			@endif
			@if ( Auth::user()->post=='super manager')
				<select name="post" class="form-control">
					@if( $user->post == 'operation' )
					<option value="operation" selected>Operation</option>
					<option value="manager">Management</option>
					<option value="multimedia">Multimedia</option>
					<option value="audit">Audit</option>
					@endif
					@if ($user->post == 'manager')
					<option value="operation" >Operation</option>
					<option value="manager" selected>Management</option>
					<option value="multimedia">Multimedia</option>
					<option value="audit">Audit</option>			  
					@endif
					{{-- @if ($user->post == 'manager'||Auth::user()->post !='super manager')
					<select name="post" class="form-control">
						<option value="{{$user->post}}"selected>You Cant Edit Post</Em></option>
						</select>			  
					@endif --}}
					@if ($user->post == 'multimedia')
					<option value="operation" >Operation</option>
					<option value="manager" >Management</option>
					<option value="multimedia"selected>Multimedia</option>
					<option value="audit">Audit</option>			  
					@endif
					@if ($user->post == 'audit')
					<option value="operation" >Operation</option>
					<option value="manager" >Management</option>
					<option value="multimedia">Multimedia</option>
					<option value="audit"selected>Audit</option>			  
					@endif
				</select>
			@endif
			@if( Auth::user()->post=='manager' &&  $user->post == 'manager')
			<select name="post" class="form-control">
			<option value="{{$user->post}}"selected>You Cant Edit Post</Em></option>
			</select>
			@endif
			@if( Auth::user()->post!='manager' &&  Auth::user()->post!='super manager')
			<select name="post" class="form-control">
			<option value="{{$user->post}}"selected>You Cant Edit Post</Em></option>
			</select>
			@endif
			{{-- @if( Auth::user()->post!='manager' )
			<select name="post" class="form-control">
			<option value="{{$user->post}}"selected>You Cant Edit Post</Em></option>
			</select>
			@endif --}}
		</div>

		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="{{ __('messages.Submit') }}">
			<a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">{{ __('messages.Go_Back') }}</a>
		</div>

	</div>




</form>

@stop

