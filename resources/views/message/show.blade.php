@extends('layout')
@section('content')
<div class="col-md-8">
<h4><strong>{{ __('messages.subject') }} : </strong> {{$message->subject}} ({{$message->created_at ->diffForHumans()}})</h5></h4>
<h4><strong>{{ __('messages.Email') }} :</strong> {{$message->email}}</h4>
<p ><br><br> {{$message->message}}<br><br></p>
    <div class="btn-group">
        <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">{{ __('messages.Go_Back') }}</a>
    </div>
</div>
@stop