@extends('layout')

@section('content')

@include('includes.errors') 

<form id="project_form" action="{{ route('customer.update', [ 'id' => $edit_cust->id ]) }}" method="POST">
    {{ csrf_field() }}

<label>{{ __('messages.Edit_Customer') }}  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></label>

<div class="row">
    <div class="col-md-8">
		
        <div class="form-group">
            <input type="text" class="form-control" placeholder="{{ __('messages.E_C_First_Name') }}" name="cust_f_name" value="{{ $edit_cust->cust_f_name }}">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="{{ __('messages.E_C_Last_Name') }}" name="cust_l_name" value="{{ $edit_cust->cust_l_name }}">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="{{ __('messages.E_C_Phone_number') }}" name="cust_phone" value="{{ $edit_cust->cust_phone }}">
    </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="{{ __('messages.E_C_Email') }}" name="cust_email" value="{{ $edit_cust->cust_email }}">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="{{ __('messages.E_C_Status') }}" name="cust_status" value="{{ $edit_cust->cust_status }}">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="{{ __('messages.E_C_Adress') }}" name="cust_adress" value="{{ $edit_cust->cust_adress}}">
    </div>
		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="{{ __('messages.Submit') }}" onclick="return validateForm()">
			<a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">{{ __('messages.Go_Back') }}</a>
		</div>
	</div>
</div>

</form>

@stop


