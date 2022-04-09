@extends('layout')

@section('content')

<h1>Project Project List for:  "{{ $c_name->cust_f_name }} {{ $c_name->cust_l_name }}" </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Project Title</th>
        <th>Customer Name</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>

@if ( !$projet_list->isEmpty() ) 
    <tbody>
    @foreach ( $projet_list as $projet)
      <tr>
        <td>{{ $projet->projet_title }} </td>
        <td>{{ $projet->customer->cust_f_name }} {{ $projet->customer->cust_l_name }}</td>
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
            @else
                <span class="label label-success">Completed</span>
            @endif
        </td>
        <td>
            <!-- <a href="{{ route('projet.edit', ['id' => $projet->id]) }}" class="btn btn-primary"> edit </a> -->
            <a href="{{ route('projet.view', ['id' => $projet->id]) }}" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
        @if ( Auth::user()->post=='manager'||Auth::user()->post=='super manager')
            <a href="{{ route('projet.delete', ['id' => $projet->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            @endif
        </td>
      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>There are no project assigned yet</em></p>
@endif


</table>



<div class="btn-group">
    <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
</div>




@stop