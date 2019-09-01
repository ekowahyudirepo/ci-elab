<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/test/reading_student/<?php echo $this->uri->segment(4); ?>'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
                <b>Questions <span class="float-right">Correct : <?php echo $qw_correct; ?>&nbsp;&nbsp;Incorrect : <?php echo $qw_incorrect; ?>&nbsp;&nbsp;Point Collection : <?php echo ($qw_point == null)? 0 : $qw_point; ?>&nbsp;&nbsp;</span></b>
            </div>
            <?php $no = 1; ?>
            <?php foreach( $qw_reading_sub_test->result() as $row ): ?>
            <div class="card-body
            <?php 

                echo ( $this->db->get_where('reading_answer', ['reading_test_id' => $this->uri->segment(4), 'student_id' => $this->uri->segment(5) ,'reading_sub_test_id' => $row->reading_sub_test_id])->row()->reading_answer_correct ==  'true' )? '' : 'bg-warning';


             ?>
            ">
                
                <div class="row">
                    <div class="col-12">
                        
                        <?php echo ( $row->reading_sub_test_intro == null )? '' : $row->reading_sub_test_intro; ?>

                        <!-- Block Question 1 -->
                        <p><?php echo $no++; ?>. <?php echo $row->reading_sub_test_question; ?> <b>Point (<?php echo $row->reading_sub_test_point; ?>)</b> &nbsp;&nbsp; <span class="text-success">Correct answer is <b><?php echo $row->reading_sub_test_answer; ?></b></span></p>
                        <div class="form-group">
                            <input type="radio" class="check" id="flat-radio-1" name="flat-radio-<?php echo $row->reading_sub_test_id; ?>" data-radio="iradio_flat-red" 
                            <?php 

                                echo ( $this->db->get_where('reading_answer', ['reading_test_id' => $this->uri->segment(4), 'student_id' => $this->uri->segment(5) ,'reading_sub_test_id' => $row->reading_sub_test_id])->row()->reading_answer_choose == 'A' )? 'checked' : '';


                             ?>
                            >
                            <label for="flat-radio-1">A. <?php echo $row->reading_sub_test_a; ?></label></br>
                            
                            <input type="radio" class="check" id="flat-radio-1" name="flat-radio-<?php echo $row->reading_sub_test_id; ?>" data-radio="iradio_flat-red"
                            <?php 

                                echo ( $this->db->get_where('reading_answer', ['reading_test_id' => $this->uri->segment(4), 'student_id' => $this->uri->segment(5) ,'reading_sub_test_id' => $row->reading_sub_test_id])->row()->reading_answer_choose == 'B' )? 'checked' : '';


                             ?>
                            >
                            <label for="flat-radio-1">B. <?php echo $row->reading_sub_test_b; ?></label></br>
                            
                            <input type="radio" class="check" id="flat-radio-1" name="flat-radio-<?php echo $row->reading_sub_test_id; ?>" data-radio="iradio_flat-red" 
                            <?php 

                                echo ( $this->db->get_where('reading_answer', ['reading_test_id' => $this->uri->segment(4), 'student_id' => $this->uri->segment(5) ,'reading_sub_test_id' => $row->reading_sub_test_id])->row()->reading_answer_choose == 'C' )? 'checked' : '';


                             ?>
                            >
                            <label for="flat-radio-1">C. <?php echo $row->reading_sub_test_c; ?></label></br>
                            
                            <input type="radio" class="check" id="flat-radio-1" name="flat-radio-<?php echo $row->reading_sub_test_id; ?>" data-radio="iradio_flat-red"
                            <?php 

                                echo ( $this->db->get_where('reading_answer', ['reading_test_id' => $this->uri->segment(4), 'student_id' => $this->uri->segment(5) ,'reading_sub_test_id' => $row->reading_sub_test_id])->row()->reading_answer_choose == 'D' )? 'checked' : '';


                             ?>
                            >
                            <label for="flat-radio-1">D. <?php echo $row->reading_sub_test_d; ?></label></br>


                        
                        </div>                      
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

