<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/test/speaking_student/<?php echo $this->uri->segment(4); ?>'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
            
            <div class="card-body">
                
                <div class="row">
                    <div class="col-12">
                        <!-- Block Question 1 -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Question</th>
                                        <th>Correct Answer</th>
                                        <th>Answer Student</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <?php $no = 1; ?>
                                <?php foreach( $qw_speaking_sub_test->result() as $row ): ?>
                                <tbody class="<?php 

                                    echo ( $this->db->get_where('speaking_answer', ['speaking_test_id' => $this->uri->segment(4), 'student_id' => $this->uri->segment(5) ,'speaking_sub_test_id' => $row->speaking_sub_test_id])->row()->speaking_answer_correct ==  'true' )? '' : 'bg-warning';


                                 ?>">
                                    <tr>
                                        <td colspan="5">
                                            <?php echo ( $row->speaking_sub_test_intro == null )? '' : $row->speaking_sub_test_intro; ?>
                                                
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td>
                                            <audio controls>
                                              <source src="<?php echo $row->speaking_sub_test_answer; ?>" type="audio/mpeg">
                                              Your browser does not support the audio element.
                                            </audio>
                                        </td>
                                        <td>
                                            <audio controls>
                                              <source src="<?php echo $row->speaking_sub_test_question; ?>" type="audio/mpeg">
                                              Your browser does not support the audio element.
                                            </audio>
                                        </td>
                                        <td>
                                            <?php 

                                                $ans = $this->db->get_where('speaking_answer', ['speaking_test_id' => $this->uri->segment(4), 'student_id' => $this->uri->segment(5) ,'speaking_sub_test_id' => $row->speaking_sub_test_id])->row();

                                                if ( $ans->speaking_answer_choose == null ) {

                                                    echo 'Not answer';

                                                } else { ?>

                                                    <audio controls>
                                                      <source src="<?php echo $ans->speaking_answer_choose; ?>" type="audio/mpeg">
                                                      Your browser does not support the audio element.
                                                    </audio>

                                            <?php }


                                             ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>teacher/test/speaking_student_correct/<?php echo $row->speaking_sub_test_id; ?>/<?php echo $this->uri->segment(5); ?>/true" class="btn btn-success"><i class="ti-check"></i></a>
                                            <a href="<?php echo base_url(); ?>teacher/test/speaking_student_correct/<?php echo $row->speaking_sub_test_id; ?>/<?php echo $this->uri->segment(5); ?>/false" class="btn btn-danger"><i class="ti-close"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

