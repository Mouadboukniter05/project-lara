@extends('layout')

@section('content')

<h1>{{ __('messages.C_C_L_for') }}:  "{{ $username->name}}" </h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>{{ __('messages.num') }}</th>

          <th>{{ __('messages.Created_At') }}</th>
        <th>{{ __('messages.Due_Date') }}</th>
          <th>{{ __('messages.Beneficiary') }} </th>
          <th>{{ __('messages.Amount') }}</th>
          <th>{{ __('messages.Assigned_To') }} </th>
          <th>{{ __('messages.Priority') }}</th>
          {{-- <th>{{ __('messages.Comment') }}</th> --}}
          <th>{{ __('messages.Status') }} </th>
          @if ( Auth::user()->post=='manager'|| Auth::user()->post=='audit'||Auth::user()->post=='super manager')
          <th>{{ __('messages.Actions') }}</th>
          @endif
        </tr>
      </thead>

@if ( !$check_list->isEmpty() ) 
    <tbody>
    @foreach ( $check_list as $check)
      <tr>
        <td>{{ $check->id}} </td>

        <td>{{ Carbon\Carbon::parse($check->created_at)->format('m-d-Y') }} </td>
        <td>{{ Carbon\Carbon::parse($check->duedate)->format('m-d-Y') }}</td>

        <td>{{ $check->bank }} </td>
        <td>{{ $check->amount }} DH</td>
        <td>
             @foreach ( $customers as $customer)
            @if($check->customer_id == $customer->id)
            {{ $customer->cust_f_name }} {{ $customer->cust_l_name }}
            @endif
            @endforeach
        </td>
        <td>
            @if ( $check->priority == 0 )
            <span class="label label-info">{{ __('messages.Taken') }}</span>
            @else
            <span class="label label-danger">{{ __('messages.Given') }}</span>
            @endif
        </td>
        {{-- <td>{{ $check->coment }} </td> --}}

        <td>
            @if ( $check->completed== 0 )
                {{-- <a href="{{ route('check.completed', ['id' => $check->id]) }}" class="btn btn-warning">{{ __('messages.cash_check') }}</a> --}}
                <span class="label label-danger">{{ __('messages.Impayé') }}</span>
                <span class="label label-danger">{{ ( $check->duedate < Carbon\Carbon::now() )  ? "!" : "" }}</span>
            @endif
            @if($check->completed==1)
                <span class="label label-success">{{ __('messages.Payer') }}</span>
            @endif
            @if($check->completed==2)
                <span class="label label-warning">{{ __('messages.Échanger') }}</span>
            @endif
            @if($check->completed==3)
                <span class="label label-primary">{{ __('messages.Annulé') }}</span>
            @endif
            

        </td>
        @if ( Auth::user()->post=='manager'|| Auth::user()->post=='audit'||Auth::user()->post=='super manager')

        <td>
            
            <a href="{{ route('check.view', ['id' => $check->id]) }}" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
            <a href="{{ route('check.delete', ['id' => $check->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

        </td>
        @endif
      </tr>

    @endforeach
    </tbody>
@else 
<p><em>{{ __('messages.no_Check') }}</em></p>
@endif


</table>



<div class="btn-group">
    <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">{{ __('messages.Go_Back') }}</a>
</div>




@stop