@extends('layouts.app')

@section('content')

    

{{-- @stop --}}


{{-- @section('content') --}}

@include('includes.errors') 
<div class="container">
    {{-- <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<div class="modal-content"> --}}
<form id="check_form" action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
   
    <div class="col-md-8">
        <label>{{ __('messages.contactus') }}</label>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="{{ __('messages.Name') }}" name="cont_name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="{{ __('messages.Email') }}" name="cont_email">
        </div>
        <div class="form-group">
            <textarea class="form-control r" rows="10" id="observation" name="cont_message"></textarea>
        </div>
        <div class="btn-group">
            <input class="btn btn-primary" type="submit" value="{{ __('messages.Send') }}" >
            {{-- <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">{{ __('messages.Go_Back') }}</a> --}}
        </div>
        
    </div>

</form>
</div>


{{-- @stop --}}
@endsection




{{-- @stop --}}





