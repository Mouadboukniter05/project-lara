@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1>{{ __('messages.USERS') }}</h1>
    </div>
</div>


<div class="new_project">
    @if ( Auth::user()->post=='manager'||Auth::user()->post=='super manager' )
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;{{ __('messages.Add_User') }}</button>
  @endif
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ __('messages.User_Information') }}</h4>
        </div>

        <div class="modal-body">
        <form id="task_form" action="{{ route('user.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <label>{{ __('messages.Create_User') }} <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></label>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{ __('messages.User_name') }} " name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{ __('messages.User_email') }}" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{ __('messages.User_phone') }}" name="phone" value="{{ old('phone') }}">
                        </div>
                        

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{ __('messages.User_Password') }}" name="password">
                        </div>

                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label>{{ __('messages.Set_Status') }} <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                        <select name="admin" class="form-control">
                            <option value="0" selected>{{ __('messages.Disabled') }} ({{ __('messages.default') }})</option>
                            <option value="1">{{ __('messages.Active') }}</option>
                        </select>
                        <label>{{ __('messages.Set_Post') }} </label>
                        <select name="post" class="form-control">
                            <option value="operation" selected>Operation</option>
                            <option value="manager">Management</option>
                            <option value="multimedia">Multimedia</option>
                            <option value="audit">Audit</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <input class="btn btn-primary" type="submit" value="{{ __('messages.Submit') }}" >
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.Close') }}</button>
            </div>


        </form>
       </div>

    </div>

  </div>
</div>
<!--  END modal  -->





<table class="table table-striped">
    <thead>
      <tr>
        <th>{{ __('messages.Name') }}</th>
        <th>{{ __('messages.Post') }}</th>
        <th>{{ __('messages.Email') }}</th>
        <th>{{ __('messages.Phone') }}</th>
        @if ( Auth::user()->post=='manager' ||Auth::user()->post=='super manager')
             <th>{{ __('messages.Status') }}</th>
        <th>{{ __('messages.Actions') }}</th>
        @endif
        
       
      </tr>
    </thead>

@if ( !$users->isEmpty() ) 
    <tbody>
    @foreach ( $users as $user)
    {{-- @if ( $user->id == 1 )  @continue 
    @endif --}}
      <tr>
        <td><a href="{{ route('user.list', ['id'=> $user->id] ) }}">{{ $user->name }}</a></td>

        <td>@if( $user->post =='manager')
                Manager
            @endif
            @if( $user->post =='operation')
            Operation
            @endif
            @if( $user->post =='multimedia')
            Multimedia
            @endif
            @if( $user->post =='audit')
            Audit
            @endif
            @if( $user->post =='super manager')
            Super Manager
            @endif
        </td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
        @if ( Auth::user()->post=='manager' &&( $user->post != 'manager')&&( $user->post != 'super manager'))
        <td>
            @if ( !$user->admin )
                <a href="{{ route('user.activate', ['id' => $user->id]) }}" class="btn btn-warning"> {{ __('messages.Activate') }} {{ __('messages.user') }}</a>
            @else
                <a href="{{ route('user.disable', ['id' => $user->id]) }}" class="btn btn-warning"> {{ __('messages.Disabled') }} {{ __('messages.user') }}</a>
                <span class="label label-success">{{ __('messages.Active') }}</span>
            @endif
        </td>
        @endif
        @if ( Auth::user()->post=='manager' &&( $user->post == 'manager'))
        <td> </td>
        @endif
        @if ( Auth::user()->post=='super manager')
        <td>
            @if ( !$user->admin )
                <a href="{{ route('user.activate', ['id' => $user->id]) }}" class="btn btn-warning">{{ __('messages.Activate') }} {{ __('messages.user') }}</a>
            @else
                <a href="{{ route('user.disable', ['id' => $user->id]) }}" class="btn btn-warning">{{ __('messages.Disabled') }} {{ __('messages.user') }}</a>
                <span class="label label-success">{{ __('messages.Active') }}</span>
            @endif
        </td>
        @endif
        <td>
            @if ( Auth::user()->post=='manager' &&( $user->post != 'manager')&&( $user->post != 'super manager'))
            
            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            @endif
            @if ( Auth::user()->post=='super manager' ||Auth::user()->id== $user->id )
            
            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            @endif
            @if ( Auth::user()->post=='manager' &&( $user->post != 'manager')&&( $user->post != 'super manager'))
           
            <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
         @endif
         @if (Auth::user()->post=='super manager')
           
            <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
         @endif
        </td>
        
      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>{{ __('messages.no_users') }}</em></p>
@endif


</table>



@stop

<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a User will also delete all tasks associated.");
  if (x)
      return true;
  else
    return false;
}




</script>  


