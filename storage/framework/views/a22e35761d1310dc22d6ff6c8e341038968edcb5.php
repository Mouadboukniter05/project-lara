<?php $__env->startSection('styles'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>


<form action="<?php echo e(route('task.update', [ 'id' => $task->id ] )); ?>" method="POST" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

	<input type="hidden" name="task_id" value="<?php echo e($task->id); ?>">

<!--
    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <hr>
    	<strong>Project Name: </strong> <?php echo e($project->project_name); ?> 
    	<strong>Project ID: </strong> <?php echo e($project->id); ?> 
    	<strong>Task->Project->ID: </strong> <?php echo e($task->project->id); ?>


    <hr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
-->


    <div class="col-md-8">

    	<div class="form-group">
    		<label>Edit Task Title</label>
			<input type="text" class="form-control"  name="task_title" value="<?php echo e($task->task_title); ?>">
		</div>

		<div class="form-group">
        <label>Add Project Files (png,gif,jpeg,jpg,txt,pdf,doc) <span class="glyphicon glyphicon-file" aria-hidden="true"></span></label>
           	<input type="file" class="form-control" name="photos[]" multiple>
       	</div>

    	<div class="form-group">
    		<label>Edit task</label>
			<textarea class="form-control my-editor" rows="5" id="task" name="task"><?php echo e($task->task); ?></textarea>
		</div>

		<div class="form-group">
		<?php if( count($taskfiles) > 0  ): ?>
		<label>Files</label>
		<ul class="fileslist">
           	<?php $__currentLoopData = $taskfiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
			    <li><?php echo e($file->filename); ?> <span>&nbsp;&nbsp;</span> <a class="btn btn-danger" href="<?php echo e(route('task.deletefile', [ 'id' => $file->id])); ?>">
			   		<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
				</li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
		<?php endif; ?>
       	</div>

	</div>

	<div class="col-md-4">


        <div class="form-group">
			 <label>Assigned to User <span class="glyphicon glyphicon-user" aria-hidden="true"></span></label>

              <select name="user_id" id="user_id" class="form-control">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" 
                          <?php if( $task->user->id == $user->id ): ?>
                                selected
                          <?php endif; ?>
                          ><?php echo e($user->name); ?>

                      	</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
        </div>

        <div class="form-group">
			 <label>Assigned to Project <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span></label>

              <select name="project_id" id="project_id" class="form-control">
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($project->id); ?>" 
                          <?php if( $task->project->id == $project->id ): ?>
                                selected
                          <?php endif; ?>
                          ><?php echo e($project->project_name); ?>

                      	</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
        </div>

	
		<div class="form-group">
			<label>Edit Priority <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></label>
			<select name="priority" class="form-control">
				<?php if( $task->priority == 0 ): ?>
			  		<option value="0" selected>Normal</option>
			  		<option value="1">High</option>
			    <?php else: ?>
			  		<option value="0">Normal</option>
			  		<option value="1" selected>High</option>
			  	<?php endif; ?>
			</select>
		</div>

		<div class="form-group">
			<label>Edit Status <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
			<select name="completed" class="form-control">
				<?php if( $task->completed == 0 ): ?>
			  		<option value="0" selected>Not Completed</option>
			  		<option value="1">Completed</option>
			  	<?php else: ?>
			  		<option value="0">Not Completed</option>
			  		<option value="1" selected>Completed</option>
			  	<?php endif; ?>
			</select>
		</div>


        <div class="form-group">
            <label>Edit Due Date <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></label>
     
                <div class='input-group date' id='datetimepicker1'>
					<input type='text' class="form-control" name="duedate" value="<?php echo e($task->duedate); ?>">
					<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
        </div>
		


		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="Submit">
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