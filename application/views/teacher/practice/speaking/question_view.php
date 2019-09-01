<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/practice/speaking_question/<?php echo $this->uri->segment(4); ?>'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
                <b>Questions</b>
            </div>
            <div class="card-body">
                <?php $no = 1; ?>
                <?php foreach( $qw_speaking_sub_test->result() as $row ): ?>
                <div class="row">
                    <div class="col-12">
                        
                        <?php echo ( $row->speaking_sub_test_intro == null )? '' : $row->speaking_sub_test_intro; ?>

                        <p>Question audio</p>
                        <audio controls>
                          <source src="<?php echo $row->speaking_sub_test_question; ?>" type="audio/mpeg">
                          Your browser does not support the audio element.
                        </audio>

                        <p>Correct answer audio</p>
                        <audio controls>
                          <source src="<?php echo $row->speaking_sub_test_answer; ?>" type="audio/mpeg">
                          Your browser does not support the audio element.
                        </audio>


                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

