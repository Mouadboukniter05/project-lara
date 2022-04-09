@extends('layout')

@section('content')

@include('includes.errors') 

<h1>{{ __('messages.All_Messages') }}</h1>

<div class="new_project">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;{{ __('messages.Create_Message') }}</button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ __('messages.Create_Message') }}</h4>
      </div>
      <div class="modal-body">
        <form id="project_form" action="{{ route('message.store') }}" method="POST">
            {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12">
            <div class="form-group">
              <label>{{ __('messages.Send_To') }} </label>
              <div class="form-group">
                <select name="email" class="selectpicker" data-style="btn-primary" style="width:100%;">
                    @foreach( $listcust as $user )
                        <option value="{{ $user->cust_email }}">{{ $user->cust_email }}</option>
                     @endforeach
                </select>
            </div>
            <div class="form-group">
            <label >
            title
            </label>
                <input class="form-control r" rows="10" id="title" name="title">
            </div>
            <div class="form-group">
                <textarea class="form-control r" rows="10" id="message" name="message"></textarea>
            </div>
            </div>
            
          </div>

        </div>
        
        <div class="modal-footer">
          <input class="btn btn-primary" type="submit" value="{{ __('messages.Send') }}" >
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.Close') }}</button>
        </div>

        </form>
      </div>

    </div>

  </div>
</div>
<!--  END modal  -->

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>{{ __('messages.Time') }}</th>
            <th>{{ __('messages.From') }}</th>
            <th>{{ __('messages.subject') }}</th>
            <th>{{ __('messages.Actions') }}</th>
          </tr>
        </thead>
    
    @if ( !$messages->isEmpty() ) 
        <tbody>
        @foreach ( $messages as $message)
        @if ( Auth::user()->post== 'super manager' || Auth::user()->post== 'manager' )
          <tr>
            <td>{{ Carbon\Carbon::parse($message->created_at)->format('m-d-Y') }}</td>
            <td>
                    <span class="label label-info">{{ $message->email }}</span>
            </td>
        <td> {{$message->subject}}</td>
            
            <td>
            <a href="{{ route('letter.pola', ['id' => $message->id]) }}" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
              <a href="{{ route('message.delete', ['id' => $message->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
    
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
