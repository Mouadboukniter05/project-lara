@extends('layout')

@section('content')

<h1>{{ __('messages.CONTACTS_MESSAGES') }}</h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>{{ __('messages.Name') }}</th>
        <th>{{ __('messages.Email') }}</th>
        <th>{{ __('messages.Time') }}</th>
        <th>{{ __('messages.Actions') }}</th>
      </tr>
    </thead>

@if ( !$contacts->isEmpty() ) 
    <tbody>
    @foreach ( $contacts as $contact)
      <tr>
        <td>{{ $contact->cont_name }} </td>
        <td>{{ $contact->cont_email }}</td>
        <td>{{ $contact->created_at	 }}</td>
        <td>
            
            <a href="{{ route('contact.view', ['id' => $contact->id]) }}" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
            <a href="{{ route('contact.delete', ['id' => $contact->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

        </td>
      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>There are no Messages yet</em></p>
@endif


</table>








@stop