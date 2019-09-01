<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/test/reading/<?php echo $qw_reading_test->reading_test_level; ?>'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <b>Questions police</b>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url(); ?>teacher/test/reading_update_police/<?php echo $this->uri->segment(4); ?>" method="post">
                <div class="row">
                    <div class="col-12">
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <textarea id="mymce" class="form-control" name="police"><?php echo $qw_reading_test->reading_test_police; ?></textarea>
                            <small class="text-muted">You can empty this field</small>
                        </div>                
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-success btn-lg"><i class="ti-save"></i> Save</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

