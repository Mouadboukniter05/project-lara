@extends('layout')

@section('content')




<div class="col-md-8">
    <h1>{{ $projet_view->projet_title }}</h1>

    <div class="form-group">
        <label>Description:</label>
        <p>{!! $projet_view->projet !!}</p>
    </div>
        

    <div class="btn-group">
        @if ( Auth::user()->post=='manager'|| Auth::user()->post=='audit'||Auth::user()->post=='super manager')
        <a href="{{ route('projet.edit', ['id' => $projet_view->id ]) }}" class="btn btn-primary"> edit </a>
        @endif
        <a class="btn btn-default" href="{{ route('projet.show') }}">Go Back</a>
    </div>

    <div class="row">
        <hr>
        @if( count($images_set) > 0 ) 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading">Uploaded Images</div>
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
                    <div class="panel-heading"> Uploaded Files</div>
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



</div>

<div class="col-md-4">


    <div class="panel panel-jc">
        <div class="panel-heading">Customer</div>
        <div class="panel-body">
            <span class="label label-jc">
                <a href="{{ route('projet.list', [ 'customerid' => $projet_view->customer->id ]) }}">{{ $projet_view->customer->cust_f_name }} {{ $projet_view->customer->cust_l_name }}</a>
            </span>
        </div>
    </div>

    <div class="panel panel-jc">
        <div class="panel-heading">Priority</div>
        <div class="panel-body">
            @if ( $projet_view->priority == 0 )
                <span class="label label-info">Normal</span>
            @else
                <span class="label label-danger">High</span>
            @endif
        </div>
    </div>



    <div class="panel panel-jc">
        <div class="panel-heading">Created</div>
        <div class="panel-body">
            {{ $formatted_from }} 
        </div>
    </div>

    <div class="panel panel-jc">
        <div class="panel-heading">Due Date</div>
        <div class="panel-body">
            {{ $formatted_to }} 
        </div>
    </div>


    <div class="panel panel-jc">
        <div class="panel-heading">Status</div>
        <div class="panel-body">
            @if ( $projet_view->completed == 0 )
                <span class="label label-warning">Open</span>
                @if ( $is_overdue )
                    <span class="label label-danger">Overdue</span>
                @else
                    <p><br>{{ $diff_in_days }} days left to complete this projet</p>
                @endif                
            @else
                <span class="label label-success">Closed</span>
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


