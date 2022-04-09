<?php $__env->startSection('styles'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-datepicker.min.css')); ?>">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('includes.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<form id="check_form" action="<?php echo e(route('check.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>


    <div class="col-md-8">
        <label>Store new Check <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></label>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter Check Beneficiary" name="beneficiary">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter Check Location" name="location">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter Check Amount" name="amount">
        </div>
        <label>Add Check Files (png,gif,jpeg,jpg,txt,pdf,doc) <span class="glyphicon glyphicon-file" aria-hidden="true"></span></label>
		<div class="form-group">
           	<input type="file" class="form-control" name="photos[]" multiple>
       	</div>

        <div class="form-group">
            <textarea class="form-control" rows="10" id="coment" placeholder="Enter Comment" name="coment"></textarea>
        </div>
        
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Assign to Customer <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span></label>
            <select   id="customer_id" name="customer_id" class="selectpicker" data-style="btn-primary" style="width:100%;">
                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->cust_f_name); ?> <?php echo e($customer->cust_l_name); ?> </option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        

        <div class="form-group">
            <label>Select Priority <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></label>
            <select name="priority" class="selectpicker" data-style="btn-info" style="width:100%;">
              <option value="0">Taken</option>
              <option value="1">Given</option>
            </select>
        </div>

        <div class="form-group">
            <label>Select Due Date <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control" name="duedate">
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <div class="btn-group">
            <input class="btn btn-primary" type="submit" value="Submit" onclick="return validateForm()">
            <a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>">Go Back</a>
        </div>

    </div>

</form>

<?php $__env->stopSection(); ?>




<?php $__env->startSection('scripts'); ?>

    <script src="<?php echo e(asset('js/moment.js')); ?>"></script> 

    <script src="<?php echo e(asset('js/bootstrap-datepicker.min.js')); ?>"></script>  

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
    path_absolute:"<?php echo e(url('/')); ?>/",
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


<?php $__env->stopSection(); ?>






<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>