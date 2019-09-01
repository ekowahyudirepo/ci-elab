<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Students Group</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<div class="row">
    <div class="col-md-12 mb-3"><h2>Group in class </h2></div>
    <div class="col-md-4">
        <div class="card">
        	<div class="card-header">Beginner</div>
            <div class="card-body">
            	<p class="text-muted">Description</p>
                <p>This group for ...</p>
            </div>
        	<div class="card-footer"><a href="<?php echo base_url(); ?>teacher/student/beginner/<?php echo $this->uri->segment(4); ?>" class="btn btn-primary"><i class="ti-eye"></i> View Student</a> <span class="badge badge-info float-right"><?php echo $qw_student_beginner; ?> Students</span></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
        	<div class="card-header">Intermediate</div>
            <div class="card-body">
            	<p class="text-muted">Description</p>
                <p>This group for ...</p>
            </div>
        	<div class="card-footer"><a href="<?php echo base_url(); ?>teacher/student/intermediate/<?php echo $this->uri->segment(4); ?>" class="btn btn-primary"><i class="ti-eye"></i> View Student</a> <span class="badge badge-info float-right"><?php echo $qw_student_intermediate; ?> Students</span></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
        	<div class="card-header">Advanced</div>
            <div class="card-body">
            	<p class="text-muted">Description</p>
                <p>This group for ...</p>
            </div>
        	<div class="card-footer"><a href="<?php echo base_url(); ?>teacher/student/advanced/<?php echo $this->uri->segment(4); ?>" class="btn btn-primary"><i class="ti-eye"></i> View Student</a> <span class="badge badge-info float-right"><?php echo $qw_student_advanced; ?> Students</span></div>
        </div>
    </div>
</div>

