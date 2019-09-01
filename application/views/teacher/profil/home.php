<?php $row = $qw_teacher->row(); ?>
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Profil</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        
    </div>
</div>

<div class="row">
    <div class="col-md-6">
		<?php echo $this->session->flashdata('message'); ?>
        <div class="card">
            <div class="card-body">
            	<form action="<?php echo base_url(); ?>teacher/profil/update_nama" method="post" novalidate>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Name</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="nama" required data-validation-required-message="This field is required" placeholder="Your name" value="<?php echo $row->teacher_name; ?>">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Email</label>
                        <div class="controls">
                            <input type="email" class="form-control" name="email" readonly="" required data-validation-required-message="This field is required" placeholder="Your name" value="<?php echo $row->teacher_email; ?>" >
                        </div>
                    </div>   
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Password</label>
                        <div class="">
                            <input type="password" class="form-control" name="password">
                            <small class="text-muted">If you won't to change you can empty this password field</small>
                        </div>
                    </div>  
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>   
                </form>
            </div>
        </div>
    </div>
</div>
