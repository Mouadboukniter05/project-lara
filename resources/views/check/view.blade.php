@extends('layout')

@section('content')




<div class="col-md-8">
    <div class="row">
        <div class="col-md-6">
    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.Beneficiary') }}:</div>
        <div class="panel-body">
            {{ $check_view->bank }}
        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.Amount') }}:</div>
        <div class="panel-body">
            {!! $check_view->amount !!} DH
        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.Location') }}:</div>
        <div class="panel-body">
            {{ $check_view->location }}
        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.observation') }}:</div>
        <div class="panel-body">
            {{ $check_view->observation }}
        </div>
    </div>
    
    </div>
</div>

    <div class="row">
        <hr>
        @if( count($images_set) > 0 ) 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading">{{ __('messages.U_Images') }}</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            @foreach ( $images_set as $image )
                                <li> 
                                    <a href="<?php echo asset("images/$image") ?>" data-lightbox="images-set">
                                        <img class="img-responsive" src="<?php echo asset("images/$image") ?>">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        @endif


        
        @if( count($files_set) > 0 ) 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading">{{ __('messages.U_Files') }}</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            @foreach ( $files_set as $file )
                                <li> 
                                    <a target="_blank" href="<?php echo asset("images/$file") ; ?>">{{ $file }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        @endif


    </div>


    <div class="btn-group">
        @if ( Auth::user()->post=='manager'|| Auth::user()->post=='audit'||Auth::user()->post=='super manager')
        <a href="{{ route('check.edit', ['id' => $check_view->id ]) }}" class="btn btn-primary">{{ __('messages.edit') }} </a>
        @endif
        <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">{{ __('messages.Go_Back') }}</a>
    </div>
</div>

<div class="col-md-4">


    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.Customer') }}</div>
        <div class="panel-body">
            <span class="label label-jc">
                @foreach( $customers as $customer) 
                @if ( $customer->id == $check_view->customer_id )
                <a href="{{ route('check.list', [ 'customerid' => $customer->id ]) }}">{{ $customer->cust_f_name }} {{ $customer->cust_l_name }}</a>
                @endif
                @endforeach
            </span>
        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.user') }}</div>
        <div class="panel-body">
            <span class="label label-jc">
                @foreach( $users as $user) 
                @if ( $user->id == $check_view->user_id )
            {{ $user->name }}
                @endif
                @endforeach
            </span>
        </div>
    </div>
    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.Priority') }}</div>
        <div class="panel-body">
            @if ( $check_view->priority == 0 )
                <span class="label label-info">{{ __('messages.Taken') }}</span>
            @else
                <span class="label label-danger">{{ __('messages.Given') }}</span>
            @endif
        </div>
    </div>



    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.Created_At') }}</div>
        <div class="panel-body">
            {{ $formatted_from }} 
        </div>
    </div>

    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.Due_Date') }}</div>
        <div class="panel-body">
            {{ $formatted_to }} 
        </div>
    </div>


    <div class="panel panel-jc">
        <div class="panel-heading">{{ __('messages.Status') }}</div>
        <div class="panel-body">
            @if ( $check_view->completed== 0 )
               
                <span class="label label-danger">Impayé</span>
                <span class="label label-danger">{{ ( $check_view->duedate < Carbon\Carbon::now() )  ? "!" : "" }}</span>
            @endif
            @if($check_view->completed==1)
                <span class="label label-success">Payer</span>
            @endif
            @if($check_view->completed==2)
                <span class="label label-warning"> Échanger contre espèce</span>
            @endif
            @if($check_view->completed==3)
                <span class="label label-primary">Annulé</span>
            @endif
        </div>
    </div>

</div>

@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
@stop


@section('scripts')
    <script src="{{ asset('js/lightbox.min.js') }}"></script>  

@stop


