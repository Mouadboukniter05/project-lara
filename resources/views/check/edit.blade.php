@extends('layout')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@stop


@section('content')

@include('includes.errors') 

<form action="{{ route('check.update', [ 'id' => $check->id ] ) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
	<input type="hidden" name="check_id" value="{{ $check->id }}">




    <div class="col-md-8">

    	<div class="form-group">
    		<label>{{ __('messages.Beneficiary') }}</label>
			<input type="text" class="form-control"  name="bank" value="{{ $check->bank }}">
		</div>
		<div class="form-group">
    		<label> {{ __('messages.Location') }}</label>
			<input type="text" class="form-control"  name="location" value="{{ $check->location }}">
		</div>
		<div class="form-group">
    		<label>{{ __('messages.Amount') }}</label>
			<input type="text" class="form-control"  name="amount" value="{{ $check->amount }}">
		</div>
		<div class="form-group">
    		<label>{{ __('messages.observation') }}</label>
			<input type="text" class="form-control"  name="observation" value="{{ $check->observation }}">
		</div>
		<div class="form-group">
        <label>{{ __('messages.U_Files') }} (png,gif,jpeg,jpg,txt,pdf,doc) <span class="glyphicon glyphicon-file" aria-hidden="true"></span></label>
           	<input type="file" class="form-control" name="photos[]" multiple>
       	</div>

    	{{-- <div class="form-group">
    		<label>{{ __('messages.Comment') }}<i class="fas fa-project-diagram    "></i></label>
			<textarea class="form-control" rows="5" id="coment" name="coment">{{ $check->coment }}</textarea>
		</div> --}}

		<div class="form-group">
		@if( count($checkfiles) > 0  )
		<label>{{ __('messages.Files') }}</label>
		<ul class="fileslist">
           	@foreach( $checkfiles as $file) 
			    <li>{{ $file->filename }} <span>&nbsp;&nbsp;</span> <a class="btn btn-danger" href="{{ route('check.deletefile', [ 'id' => $file->id]) }}">
			   		<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
				</li>
			@endforeach
		</ul>
		@endif
       	</div>

	</div>

	<div class="col-md-4">


        <div class="form-group">
			 <label>{{ __('messages.A_to_User') }} <span class="glyphicon glyphicon-user" aria-hidden="true"></span></label>

              <select name="customer_id" id="customer_id" class="form-control">
                    @foreach( $customers as $customer)
                        <option value="{{ $customer->id }}" 
                          @if( $check->customer_id == $customer->id )
                                selected
                          @endif
                          >{{ $customer->cust_f_name }} {{ $customer->cust_l_name }}
                      	</option>
                    @endforeach
              </select>
        </div>

        {{--   --}}

	
		<div class="form-group">
			<label>{{ __('messages.Priority') }} <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></label>
			<select name="priority" class="form-control">
				@if( $check->priority == 0 )
			  		<option value="0" selected>{{ __('messages.Taken') }}</option>
			  		<option value="1">{{ __('messages.Given') }}</option>
			    @else
			  		<option value="0">{{ __('messages.Taken') }}</option>
			  		<option value="1" selected>{{ __('messages.Given') }}</option>
			  	@endif
			</select>
		</div>

		<div class="form-group">
			<label>{{ __('messages.Status') }} <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
			<select name="completed" class="form-control">
				@if( $check->completed == 0 )
			  		<option value="0" selected>{{ __('messages.Impayé') }}</option>
			  		<option value="1">{{ __('messages.Payer') }} </option>
			  		<option value="2">{{ __('messages.Échanger') }} </option>
			  		<option value="3">{{ __('messages.Annulé') }} </option>
				  @endif
				  @if( $check->completed == 1 )
				  <option value="0" >{{ __('messages.Impayé') }}</option>
				  <option value="1"selected>{{ __('messages.Payer') }} </option>
				  <option value="2">{{ __('messages.Échanger') }}</option>
				  <option value="3">{{ __('messages.Annulé') }} </option>
				@endif
				@if( $check->completed == 2 )
				<option value="0" >{{ __('messages.Impayé') }}</option>
				<option value="1"selected>{{ __('messages.Payer') }} </option>
				<option value="2">{{ __('messages.Échanger') }}</option>
				<option value="3">{{ __('messages.Annulé') }} </option>
				@endif
				@if( $check->completed == 3 )
				<option value="0" selected>{{ __('messages.Impayé') }}</option>
				<option value="1">{{ __('messages.Payer') }} </option>
				<option value="2">{{ __('messages.Échanger') }}</option>
				<option value="3"selected>{{ __('messages.Annulé') }} </option>
			@endif
			</select>
		</div>


        <div class="form-group">
            <label>{{ __('messages.Due_Date') }} <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></label>
     
                <div class='input-group date' id='datetimepicker1'>
					<input type='text' class="form-control" name="duedate" value="{{ $check->duedate }}">
					<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
        </div>
		


		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="{{ __('messages.Submit') }}">
			<a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">{{ __('messages.Go_Back') }}</a>
		</div>

	</div>




</form>

@stop



@section('scripts')

    <script src="{{ asset('js/moment.js') }}"></script> 

    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>  

	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

	<script>

		jQuery('#datetimepicker1').datetimepicker( {
			defaultDate:'now',  // defaults to today
			format: 'YYYY-MM-DD hh:mm:ss'   // YEAR-MONTH-DAY hour:minute:seconds
			// minDate:new Date()  // Disable previous dates, minimum is todays date
		});

	</script>

<script>
  var editor_config = {
    //path_absolute : "/",
    path_absolute:"{{ url('/') }}/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    },

    //  Add Bootstrap Image Responsive class for inserted images
    image_class_list: [
        {title: 'None', value: ''},
        {title: 'Bootstrap responsive image', value: 'img-responsive'},
    ]

  };

  tinymce.init(editor_config);
</script>
 



@stop
