<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>student/test/reading'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    	<?php echo $this->session->flashdata('message'); ?>
    </div>
    <div class="col-md-12">
        <div class="card">
        	<div class="card-header">
                <b>Police</b>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body" style="height: 33vh;overflow-y: auto;">
                    	<?php echo $qw_reading_test->reading_test_police; ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <form action="<?php echo base_url(); ?>student/test/reading_question_view/<?php echo $this->uri->segment(4); ?>">
                    <input type="checkbox" name="agree" value="agree" class="check" id="flat-checkbox-1" data-checkbox="icheckbox_flat-red" required="">
                	<button type="submit" class="btn btn-primary">Yes I'm Agree and Start now</button>
                </form>
            </div>
        </div>
    </div>
</div>