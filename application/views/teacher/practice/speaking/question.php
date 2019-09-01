<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/practice/speaking/<?php echo $qw_speaking_sub_test->row()->speaking_test_level; ?>'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
                <b>Practice</b>
                <b class="float-right">Point Total : <?php echo $qw_point_total; ?> &nbsp;&nbsp; <a class="btn btn-primary" href="<?php echo base_url(); ?>teacher/practice/speaking_question_view/<?php echo $this->uri->segment(4); ?>">View Practice</a></b>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo base_url(); ?>teacher/practice/speaking_question_input/<?php echo $this->uri->segment(4); ?>" class="float-right btn waves-effect waves-light btn-info"><i class="ti-plus"></i> Create</a>
                    	<div class="clearfix"></div>
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr align="center">
                                    <th style="width: 50px;">No</th>
                                    <th>Intro</th>
                                    <th>Question</th>
                                    <th>Point</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $no = 1; ?>
                                <?php foreach($qw_speaking_sub_test->result() as $row): ?>
                                <?php if( $row->speaking_sub_test_question != '' ): ?>
                                <tr>
                                    <td align="center"><?php echo $no++;  ?></td>
                                    <td><?php echo ( $row->speaking_sub_test_intro == null )? 'Nothing Intro' : $row->speaking_sub_test_intro ; ?></td>
                                    <td>
                                        <audio controls>
                                          <source src="<?php echo $row->speaking_sub_test_question; ?>" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                        </audio>
                                        <div class="text-center m-3">Correct Answer</div>
                                        <audio controls>
                                          <source src="<?php echo $row->speaking_sub_test_answer; ?>" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                        </audio>
                                    </td>
                                    <td><?php echo $row->speaking_sub_test_point; ?></td>
                                    <td align="center"><a href="<?php echo base_url(); ?>teacher/practice/speaking_question_del/<?php echo $row->speaking_sub_test_id; ?>" class="btn btn-primary"><i class="ti-trash"></i></a></td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>