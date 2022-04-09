@extends('layout')


@section('styles')

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

@stop


@section('content')

@include('includes.errors') 

<form id="check_form" action="{{ route('check.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="col-md-8">
        <label>{{ __('messages.Store_Check') }}<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></label>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="{{ __('messages.E_Check_Beneficiary') }}" name="bank">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="{{ __('messages.E_Check_Location') }}" name="location">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="{{ __('messages.E_Check_Amount') }}" name="amount">
        </div>
        <label>{{ __('messages.A_Check_Files') }} (png,gif,jpeg,jpg,txt,pdf,doc) <span class="glyphicon glyphicon-file" aria-hidden="true"></span></label>
		<div class="form-group">
           	<input type="file" class="form-control" name="photos[]" multiple>
       	</div>

        {{-- <div class="form-group">
            <textarea class="form-control" rows="10" id="coment" placeholder="{{ __('messages.Enter_Comment') }}" name="coment"></textarea>
        </div> --}}
        
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('messages.A_to_Customer') }} <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span></label>
            <select   id="customer_id" name="customer_id" class="selectpicker" data-style="btn-primary" style="width:100%;">
                @foreach( $customers as $customer )
                    <option value="{{ $customer->id }}">{{ $customer->cust_f_name }} {{ $customer->cust_l_name }} </option>
                 @endforeach
            </select>
        </div>

        

        <div class="form-group">
            <label>{{ __('messages.Select_Priority') }}<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></label>
            <select name="priority" class="selectpicker" data-style="btn-info" style="width:100%;">
              <option value="0">{{ __('messages.Taken') }}</option>
              <option value="1">{{ __('messages.Given') }}</option>
            </select>
        </div>
        <div class="form-group">
            <label>{{ __('messages.Status') }}<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></label>
            <select name="completed" class="selectpicker" data-style="btn-info" style="width:100%;">
              <option value="0">{{ __('messages.Impayé') }}</option>
              <option value="1">{{ __('messages.Payer') }}</option>
              <option value="2">{{ __('messages.Échanger') }}</option>
              <option value="3">{{ __('messages.Annulé') }}</option>
            </select>
        </div>
        <div class="form-group">
            <textarea class="form-control r" rows="10" id="observation" name="observation"></textarea>
        </div>
        <div class="form-group">
            <label>{{ __('messages.Select_Due_Date') }}<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control" name="duedate">
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="btn-group">
            <input class="btn btn-primary" type="submit" value="{{ __('messages.Submit') }}" onclick="return validateForm()">
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
        jQuery(document).ready(function() {

            jQuery(function() {
                jQuery('#datetimepicker1').datetimepicker( {
                    defaultDate:'now',  // defaults to today
                    format: 'YYYY-MM-DD hh:mm:ss',  // YEAR-MONTH-DAY hour:minute:seconds
                    minDate:new Date()  // Disable previous dates, minimum is todays date
                });
            });
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





