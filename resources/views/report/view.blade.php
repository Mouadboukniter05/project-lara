@extends('layout')

@section('content')




<div class="col-md-8">
    <h1>{{ $report_view->raport_title }}</h1>

    <div class="form-group">
        <label>{{ __('messages.Report') }}:</label>
        <p>{!! $report_view->raport !!}</p>
    </div>
        

    <div class="btn-group">
        @if ( Auth::user()->post=='manager'|| Auth::user()->post=='audit'||Auth::user()->post=='super manager')
        <a href="{{ route('report.edit', ['id' => $report_view->id ]) }}" class="btn btn-primary">{{ __('messages.edit') }}</a>
        @endif
        <a class="btn btn-default" href="{{ route('report.show') }}">{{ __('messages.Go_Back') }}</a>
    </div>

  
</div>

<div class="col-md-4">



    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.user') }}</div>
        <div class="panel-body">
            @foreach( $users as $user) 
                @if ( $user->id == $report_view->user_id )
                <span class="label label-info"> {{ $user->name }}</span>
                @endif
            @endforeach
        </div>
    </div>



    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.Created_At') }}</div>
        <div class="panel-body">
            {{ $report_view->created_at }}
        </div>
    </div>


</div>

@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
@stop


@section('scripts')
    <script src="{{ asset('js/lightbox.min.js') }}"></script>  

@stop


