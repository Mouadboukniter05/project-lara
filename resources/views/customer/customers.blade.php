@extends('layout')

@section('content')

@include('includes.errors') 

<h1>{{ __('messages.LIST_CUSTOMER') }}</h1>

<div class="new_project">
  @if ( Auth::user()->post=='manager'|| Auth::user()->post=='operation'||Auth::user()->post=='super manager')
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;{{ __('messages.New_Customer') }}</button>
  @endif
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ __('messages.E_C_Information') }}</h4>
      </div>
      <div class="modal-body">
        <form id="project_form" action="{{ route('customer.store') }}" method="POST">
            {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12">
            <div class="form-group">
              <label>{{ __('messages.New_Customer') }} <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></label>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="{{ __('messages.E_C_First_Name') }}" name="cust_f_name" value="{{ old('cust_f_name') }}">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="{{ __('messages.E_C_Last_Name') }}" name="cust_l_name" value="{{ old('cust_l_name') }}">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="{{ __('messages.E_C_Phone_number') }}" name="cust_phone" value="{{ old('cust_phone') }}">
        </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="{{ __('messages.E_C_Email') }}" name="cust_email" value="{{ old('cust_email') }}">
            </div>
           
          <div class="form-group">
            <input type="text" class="form-control" placeholder="{{ __('messages.E_C_Adress') }}" name="cust_adress" value="{{ old('cust_adress') }}">
        </div>
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



<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th> {{ __('messages.Name') }}</th>
        <th>{{ __('messages.Phone') }}</th>
        <th>{{ __('messages.Email') }}</th>
      
        <th>{{ __('messages.Adress') }}</th>
        {{-- <th>Customer Project List</th> --}}
        <th>{{ __('messages.C_Check_List') }}</th>
        <th>{{ __('messages.Phone') }}</th>
      </tr>
    </thead>

@if ( !$customers->isEmpty() ) 
    <tbody>
    @foreach ( $customers  as $customer)
      <tr>
        <td>{{ $customer->cust_f_name }} {{ $customer->cust_l_name }} </td>
        <td>{{ $customer->cust_phone }} </td>
        <td>{{ $customer->cust_email }} </td>
     
        <td>{{ $customer->cust_adress }} </td>
        {{-- <td>
           <a href="{{ route('projet.list', [ 'customerid' => $customer->id ]) }}">List all projet</a>
        </td> --}}
        <td>
          <a href="{{ route('check.list', [ 'customerid' => $customer->id ]) }}">{{ __('messages.List_all_check') }}</a>
       </td>
        <td>
          <a class="btn btn-primary" href="{{ route('customer.edit', [ 'id' => $customer->id ]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
        @if ( Auth::user()->post=='manager'|| Auth::user()->post=='audit'||Auth::user()->post=='super manager')
          <a class="btn btn-danger" href="{{ route('customer.delete', [ 'id' => $customer->id ]) }}" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;
       @endif
        </td> 

      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>There are no Customers yet</em></p>
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
