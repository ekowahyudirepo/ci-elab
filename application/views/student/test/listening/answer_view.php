<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>student/test/listening'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
                <b>Result Your Test <span class="float-right">Your Point Collection : <?php echo $qw_point; ?>&nbsp;&nbsp; <?php if( $qw_point_pass == 'Pass' ){ ?><span class="text-success">Yeah !! you is Pass</span><?php }else{ ?><span class="text-danger">I'm Sorry you is not pass</span><?php } ?></span></b>
            </div>
            <?php $no = 1; ?>
            <?php $i  = -1; ?>
            <?php foreach( $qw_listening_sub_test->result() as $row ): $i++; ?>
            <div class="card-body 

            <?php 


                echo ( $qw_answer[$i] == $row->listening_sub_test_answer )? '' : 'bg-warning';


             ?>

            ">   
                <div class="row">
                    <div class="col-12">
                        
                        <?php echo ( $row->listening_sub_test_intro == null )? '' : $row->listening_sub_test_intro; ?>

                        <?php if( $row->listening_sub_test_dir != null ): ?>
                            <p>Question audio</p>
                            <audio controls>
                              <source src="<?php echo $row->listening_sub_test_dir; ?>" type="audio/mpeg">
                              Your browser does not support the audio element.
                            </audio>
                        <?php endif; ?>

                        <!-- Block Question 1 -->
                        <p><?php echo $no++; ?>. <?php echo $row->listening_sub_test_question; ?> <b>Point (<?php echo $row->listening_sub_test_point; ?>) Correct answer is <?php echo $row->listening_sub_test_answer; ?></b></p>
                        <div class="form-group">
                            <input type="radio" class="check" id="flat-radio-1" name="choose<?php echo $row->listening_sub_test_id; ?>" data-radio="iradio_flat-red" 

                            <?php 


                                echo ( $qw_answer[$i] == 'A' )? 'checked' : '';


                             ?>

                            >
                            <label for="flat-radio-1">A. <?php echo $row->listening_sub_test_a; ?></label></br>
                            
                            <input type="radio" class="check" id="flat-radio-1" name="choose<?php echo $row->listening_sub_test_id; ?>" data-radio="iradio_flat-red" 

                            <?php 


                                echo ( $qw_answer[$i] == 'B' )? 'checked' : '';


                             ?>

                            >
                            <label for="flat-radio-1">B. <?php echo $row->listening_sub_test_b; ?></label></br>
                            
                            <input type="radio" class="check" id="flat-radio-1" name="choose<?php echo $row->listening_sub_test_id; ?>" data-radio="iradio_flat-red" 

                            <?php 


                                echo ( $qw_answer[$i] == 'C' )? 'checked' : '';


                             ?>

                            >
                            <label for="flat-radio-1">C. <?php echo $row->listening_sub_test_c; ?></label></br>
                            
                            <input type="radio" class="check" id="flat-radio-1" name="choose<?php echo $row->listening_sub_test_id; ?>" data-radio="iradio_flat-red" 

                            <?php 


                                echo ( $qw_answer[$i] == 'D' )? 'checked' : '';


                             ?>

                            >
                            <label for="flat-radio-1">D. <?php echo $row->listening_sub_test_d; ?></label></br>


                        
                        </div>                      
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>      
    </div>
</div>


