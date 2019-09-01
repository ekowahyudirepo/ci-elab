<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Practice</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
    </div>
</div>


<div class="row">

	<div class="col-4">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> <img src="../assets/images/users/5.jpg" class="img-circle" width="150">
                    <h3 class="card-subtitle mt-3"><b><?php echo $qw_teacher->teacher_name; ?></b></h3>
                    <div class="row text-center justify-content-md-center">
                        <div class="col-4">
                        	<a href="javascript:void(0)" class="link">
                        		<i class="ti-book"></i> 
                        		<font class="font-medium">
                        		<?php echo $this->db->get_where('library', ['library_actor' => 'teacher', 'actor_id' => $qw_teacher->teacher_id ])->num_rows(); ?>
                        		</font>
                        	</a>
                        </div>
                        <div class="col-4">
                        	<a href="javascript:void(0)" class="link">
                        		<i class="ti-user"></i> 
                        		<font class="font-medium">
                        		10
                        		</font>
                        	</a>
                        </div>
                    </div>
                </center>
            </div>
            <div>
                <hr> 
            </div>
            <div class="card-body text-center"> 
            	<small class="text-muted">Email address </small>
                <h6><?php echo $qw_teacher->teacher_email; ?></h6> 
                <small class="text-muted p-t-30 db">Phone</small>
                <h6><?php echo $qw_teacher->teacher_phone; ?></h6>
            </div>
        </div>
    </div>

    <div class="col-8">
	    <div class="col-md-12">
		    <div class="card">
		        <div class="d-flex flex-row">
		            <div class="p-10 bg-info p-4 text-center" style="width: 100%;">
		                <h1 class="text-white box m-b-0"><i class="fa fa-book"></i><br> Reading</h1></div>
		            <div class="align-self-center text-center" style="width: 100%;">
		            	<a class="btn btn-primary m-3" href="<?php echo base_url(); ?>student/practice/reading">Course</a>
		            </div>
		        </div>
		    </div>
		</div>

		<div class="col-md-12">
		    <div class="card">
		        <div class="d-flex flex-row">
		            <div class="p-10 bg-success p-4 text-center" style="width: 100%;">
		                <h1 class="text-white box m-b-0"><i class="fa fa-check-square"></i><br> Grammar</h1></div>
		            <div class="align-self-center text-center" style="width: 100%;">
		            	<a class="btn btn-primary m-3" href="<?php echo base_url(); ?>student/practice/grammer">Course</a>
		            </div>
		        </div>
		    </div>
		</div>

		<div class="col-md-12">
		    <div class="card">
		        <div class="d-flex flex-row">
		            <div class="p-10 bg-danger p-4 text-center" style="width: 100%;">
		                <h1 class="text-white box m-b-0"><i class="fa fa-headphones"></i><br> Listening</h1></div>
		            <div class="align-self-center text-center" style="width: 100%;">
		            	<a class="btn btn-primary m-3" href="<?php echo base_url(); ?>student/practice/listening">Course</a>
		            </div>
		        </div>
		    </div>
		</div>

		<div class="col-md-12">
		    <div class="card">
		        <div class="d-flex flex-row">
		            <div class="p-10 bg-warning p-4 text-center" style="width: 100%;">
		                <h1 class="text-white box m-b-0"><i class="fa fa-microphone"></i><br> Speaking</h1></div>
		            <div class="align-self-center text-center" style="width: 100%;">
		            	<a class="btn btn-primary m-3" href="<?php echo base_url(); ?>student/practice/speaking">Course</a>
		            </div>
		        </div>
		    </div>
		</div>

		<div class="col-md-12">
		    <div class="card">
		        <div class="d-flex flex-row">
		            <div class="p-10 bg-dark p-4 text-center" style="width: 100%;">
		                <h1 class="text-white box m-b-0"><i class="fa fa-pencil"></i><br> Writing</h1></div>
		            <div class="align-self-center text-center" style="width: 100%;">
		            	<a class="btn btn-primary m-3 disabled" href="#">Upgrade</a>
		            </div>
		        </div>
		    </div>
		</div>
	</div>

</div>