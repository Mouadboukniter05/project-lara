@extends('layout')

@section('content')

<!--   /views/task/task/tasks.blade.php   -->
<div class="row">
    <div class="col-md-6">
        <h1>ALL Message</h1>
    </div>

</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Time</th>
        <th>From</th>
        <th>title</th>
        <th>Action</th>
      </tr>
    </thead>

@if ( !$messages->isEmpty() ) 
    <tbody>
    @foreach ( $messages as $message)
      <tr>
        <td>{{ Carbon\Carbon::parse($message->created_at)->format('m-d-Y') }}</td>
        <td>
         
            @foreach( $users as $user) 
                @if ( $user->id == $message->user_id )
                <span class="label label-info">{{ $messages->email }}</span>
                @endif
            @endforeach

        </td>
    <td> {{$message->title}}</td>
        <td>
            @if ( $task->priority == 0 )
                <span class="label label-info">Normal</span>
            @else
                <span class="label label-danger">High</span>
            @endif
        </td>
        <td>
            <a href="{{ route('task.delete', ['id' => $task->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

        </td>
      </tr>

    @endforeach
    </tbody>

    {{ $tasks->links() }}


@else 
    <p><em>You have no Messages</em></p>
@endif


</table>
</div>


@stop