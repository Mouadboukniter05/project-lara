@extends('layout')

@section('content')

<!--   /views/task/task/tasks.blade.php   -->
<div class="row">
    <div class="col-md-6">
        <h1>ALL Project</h1>
    </div>

    <div class="col-md-6">
        <form action="{{ route('projet.search') }}" class="navbar-form" role="search" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search in projet..." name="search_projet">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search">
                            <span class="sr-only">Search...</span>
                        </span>
                    </button>
                </span>
            </div>
        </form>
    </div> 

</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Created At</th>
        <th><a href="{{ route('projet.sort', [ 'key' => 'projet' ]) }}">Projet Title <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span> </a></th>
        <th>Assigned To / Customer</th>
        <th>Priority </a></th>
        <th>Status </th>
        <th>Actions</th>
      </tr>
    </thead>

@if ( !$projets->isEmpty() ) 
    <tbody>
    @foreach ( $projets as $projet)
      <tr>
        <td>{{ Carbon\Carbon::parse($projet->created_at)->format('m-d-Y') }}</td>
        <td>{{ $projet->projet_title }} </td>

        <td>
         
            @foreach( $users as $user) 
                @if ( $user->id == $projet->user_id )
                    <a href="{{ route('user.list', [ 'id' => $user->id ]) }}">{{ $user->name }}</a>
                @endif
            @endforeach
            <span class="label label-jc">{{ $projet->customer->cust_f_name }} {{ $projet->customer->cust_l_name }}</span>

        </td>

        <td>
            @if ( $projet->priority == 0 )
                <span class="label label-info">Normal</span>
            @else
                <span class="label label-danger">High</span>
            @endif
        </td>
        <td>
            @if ( !$projet->completed )
                <a href="{{ route('projet.completed', ['id' => $projet->id]) }}" class="btn btn-warning"> Mark as completed</a>
                <span class="label label-danger">{{ ( $projet->duedate < Carbon\Carbon::now() )  ? "!" : "" }}</span>
            @else
                <span class="label label-success">Completed</span>
            @endif
  
            

        </td>
        <td>
            <a href="{{ route('projet.view', ['id' => $projet->id]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
            @if ( Auth::user()->post=='manager'||Auth::user()->post=='super manager')
            <a href="{{ route('projet.delete', ['id' => $projet->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            @endif
        </td>
      </tr>

    @endforeach
    </tbody>

    {{ $projets->links() }}


@else 
    <p><em>There are no project assigned yet</em></p>
@endif


</table>
</div>


@stop