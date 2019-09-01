<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>student/test/speaking'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
                                    </tr>
                                </thead>
                                <?php $no = 1; ?>
                                <?php foreach( $qw_speaking_sub_test->result() as $row ): ?>
                                <tbody class="<?php 

                                    echo ( $this->db->get_where('speaking_answer', ['speaking_test_id' => $this->uri->segment(4), 'student_id' => $this->session->userdata('__ci_studentid') ,'speaking_sub_test_id' => $row->speaking_sub_test_id])->row()->speaking_answer_correct ==  'true' )? '' : 'bg-warning';


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

                                                $ans = $this->db->get_where('speaking_answer', ['speaking_test_id' => $this->uri->segment(4), 'student_id' => $this->session->userdata('__ci_studentid') ,'speaking_sub_test_id' => $row->speaking_sub_test_id])->row();

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

