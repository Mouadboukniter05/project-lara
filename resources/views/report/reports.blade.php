@extends('layout')

@section('content')

<!--   /views/task/task/tasks.blade.php   -->
<div class="row">
    <div class="col-md-6">
        <h1>{{ __('messages.ALL_Reports') }}</h1>
    </div>
</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>{{ __('messages.Created_At') }}</th>
         <th>{{ __('messages.user') }}</th>
         <th>{{ __('messages.Title') }}</th>
         <th>{{ __('messages.Actions') }}</th>
      </tr>
    </thead>

@if ( !$reports->isEmpty() ) 
    <tbody>
    @foreach ( $reports as $report)
      <tr>
        <td>{{ Carbon\Carbon::parse($report->created_at)->format('m-d-Y') }}</td>

        <td>
         
            @foreach( $users as $user) 
                @if ( $user->id == $report->user_id )
                <span class="label label-info"> {{ $user->name }}</span>
                @endif
            @endforeach
        </td>
        <td>{{ $report->raport_title }} </td>

        <td>
            <a href="{{ route('report.view', ['id' => $report->id]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
        @if ( Auth::user()->post=='manager'||Auth::user()->post=='super manager')
            <a href="{{ route('report.delete', ['id' => $report->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            @endif
        </td>
      </tr>

    @endforeach
    </tbody>


@else 
    <p><em>{{ __('messages.no_report') }}</em></p>
@endif


</table>
</div>


@stop