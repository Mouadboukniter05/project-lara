@extends('layout')

@section('content')

@include('includes.errors') 

<h1>{{ __('messages.All_Messages') }}</h1>




<!--  END modal  -->

<div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ __('messages.Time') }}</th>
          <th>{{ __('messages.to') }}</th>
          <th>{{ __('messages.Message') }}</th>
          <th>{{ __('messages.Actions') }}</th>
        </tr>
      </thead>
    
    @if ( !$messages->isEmpty() ) 
        <tbody>
        @foreach ( $messages as $message)
        @if ( Auth::user()->id== $message->user_id )
          <tr>
            <td>{{ Carbon\Carbon::parse($message->created_at)->format('m-d-Y') }}</td>
            {{-- <td>
             
                @foreach( $users as $user) 
                    @if ( $user->id == $message->user_id )
                    <span class="label label-info">{{ $user->email }}</span>
                    @endif
                @endforeach
    
            </td> --}}
        <td> <span class="label label-info">{{$message->email}}</span></td>

        <td> {{$message->message}}</td>
            
            <td>
                <a href="{{ route('boit_message.delete', ['id' => $message->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
    
            </td>
          </tr>
    @endif
        @endforeach
        </tbody>
    
        
    
    
    @else 
        <p><em>{{ __('messages.no_Messages') }}</em></p>
    @endif
    
    
    </table>
    </div>
    
    
    @stop
<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a Customer will also delete all Project associated with this project");
  if (x)
      return true;
  else
    return false;
}




</script>  
