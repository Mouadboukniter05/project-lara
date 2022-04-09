<?php $__env->startSection('styles'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('includes.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<form action="<?php echo e(route('check.update', [ 'id' => $check->id ] )); ?>" method="POST" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

	<input type="hidden" name="check_id" value="<?php echo e($check->id); ?>">




    <div class="col-md-8">

    	<div class="form-group">
    		<label><?php echo e(__('messages.Beneficiary')); ?></label>
			<input type="text" class="form-control"  name="bank" value="<?php echo e($check->bank); ?>">
		</div>
		<div class="form-group">
    		<label> <?php echo e(__('messages.Location')); ?></label>
			<input type="text" class="form-control"  name="location" value="<?php echo e($check->location); ?>">
		</div>
		<div class="form-group">
    		<label><?php echo e(__('messages.Amount')); ?></label>
			<input type="text" class="form-control"  name="amount" value="<?php echo e($check->amount); ?>">
		</div>
		<div class="form-group">
    		<label><?php echo e(__('messages.observation')); ?></label>
			<input type="text" class="form-control"  name="observation" value="<?php echo e($check->observation); ?>">
		</div>
		<div class="form-group">
        <label><?php echo e(__('messages.U_Files')); ?> (png,gif,jpeg,jpg,txt,pdf,doc) <span class="glyphicon glyphicon-file" aria-hidden="true"></span></label>
           	<input type="file" class="form-control" name="photos[]" multiple>
       	</div>

    	

		<div class="form-group">
		<?php if( count($checkfiles) > 0  ): ?>
		<label><?php echo e(__('messages.Files')); ?></label>
		<ul class="fileslist">
           	<?php $__currentLoopData = $checkfiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
			    <li><?php echo e($file->filename); ?> <span>&nbsp;&nbsp;</span> <a class="btn btn-danger" href="<?php echo e(route('check.deletefile', [ 'id' => $file->id])); ?>">
			   		<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
				</li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
		<?php endif; ?>
       	</div>

	</div>

	<div class="col-md-4">


        <div class="form-group">
			 <label><?php echo e(__('messages.A_to_User')); ?> <span class="glyphicon glyphicon-user" aria-hidden="true"></span></label>

              <select name="customer_id" id="customer_id" class="form-control">
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($customer->id); ?>" 
                          <?php if( $check->customer_id == $customer->id ): ?>
                                selected
                          <?php endif; ?>
                          ><?php echo e($customer->cust_f_name); ?> <?php echo e($customer->cust_l_name); ?>

                      	</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
        </div>

        

	
		<div class="form-group">
			<label><?php echo e(__('messages.Priority')); ?> <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></label>
			<select name="priority" class="form-control">
				<?php if( $check->priority == 0 ): ?>
			  		<option value="0" selected><?php echo e(__('messages.Taken')); ?></option>
			  		<option value="1"><?php echo e(__('messages.Given')); ?></option>
			    <?php else: ?>
			  		<option value="0"><?php echo e(__('messages.Taken')); ?></option>
			  		<option value="1" selected><?php echo e(__('messages.Given')); ?></option>
			  	<?php endif; ?>
			</select>
		</div>

		<div class="form-group">
			<label><?php echo e(__('messages.Status')); ?> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
			<select name="completed" class="form-control">
				<?php if( $check->completed == 0 ): ?>
			  		<option value="0" selected><?php echo e(__('messages.Impayé')); ?></option>
			  		<option value="1"><?php echo e(__('messages.Payer')); ?> </option>
			  		<option value="2"><?php echo e(__('messages.Échanger')); ?> </option>
			  		<option value="3"><?php echo e(__('messages.Annulé')); ?> </option>
				  <?php endif; ?>
				  <?php if( $check->completed == 1 ): ?>
				  <option value="0" ><?php echo e(__('messages.Impayé')); ?></option>
				  <option value="1"selected><?php echo e(__('messages.Payer')); ?> </option>
				  <option value="2"><?php echo e(__('messages.Échanger')); ?></option>
				  <option value="3"><?php echo e(__('messages.Annulé')); ?> </option>
				<?php endif; ?>
				<?php if( $check->completed == 2 ): ?>
				<option value="0" ><?php echo e(__('messages.Impayé')); ?></option>
				<option value="1"selected><?php echo e(__('messages.Payer')); ?> </option>
				<option value="2"><?php echo e(__('messages.Échanger')); ?></option>
				<option value="3"><?php echo e(__('messages.Annulé')); ?> </option>
				<?php endif; ?>
				<?php if( $check->completed == 3 ): ?>
				<option value="0" selected><?php echo e(__('messages.Impayé')); ?></option>
				<option value="1"><?php echo e(__('messages.Payer')); ?> </option>
				<option value="2"><?php echo e(__('messages.Échanger')); ?></option>
				<option value="3"selected><?php echo e(__('messages.Annulé')); ?> </option>
			<?php endif; ?>
			</select>
		</div>


        <div class="form-group">
            <label><?php echo e(__('messages.Due_Date')); ?> <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></label>
     
                <div class='input-group date' id='datetimepicker1'>
					<input type='text' class="form-control" name="duedate" value="<?php echo e($check->duedate); ?>">
					<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
        </div>
		


		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="<?php echo e(__('messages.Submit')); ?>">
			<a class="btn btn-default" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>"><?php echo e(__('messages.Go_Back')); ?></a>
		</div>

	</div>




</form>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>

    <script src="<?php echo e(asset('js/moment.js')); ?>"></script> 

    <script src="<?php echo e(asset('js/bootstrap-datepicker.min.js')); ?>"></script>  

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