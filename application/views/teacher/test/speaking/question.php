<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/test/speaking/<?php echo $qw_speaking_sub_test->row()->speaking_test_level; ?>'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
                <b class="float-right">Point Total : <?php echo $qw_point_total; ?> &nbsp;&nbsp; <a class="btn btn-primary" href="<?php echo base_url(); ?>teacher/test/speaking_question_view/<?php echo $this->uri->segment(4); ?>">View Practice</a></b>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <span class="float-right">
                            <a href="<?php echo base_url(); ?>teacher/test/speaking_question_input/<?php echo $this->uri->segment(4); ?>" class="btn waves-effect waves-light btn-info"><i class="ti-plus"></i> Create</a>
                            <a href="#get" data-toggle="modal" class="btn waves-effect waves-light btn-primary"><i class="ti-plus"></i> Get from practice</a>
                        </span>
                        
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
                                    <td align="center"><a href="<?php echo base_url(); ?>teacher/test/speaking_question_del/<?php echo $row->speaking_sub_test_id; ?>" class="btn btn-primary"><i class="ti-trash"></i></a></td>
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

<!-- Modal Create -->
<div id="get" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Practice question</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <th style="width: 50px;">No</th>
                                <th>Name</th>
                                <th>Point to Pass</th>
                                <th>Date add</th>
                                <th>Question</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($qw_speaking_test->result() as $row2): ?>
                            <tr>
                                <td align="center"><?php echo $no++;  ?></td>
                                <td><?php echo $row2->speaking_test_name; ?></td>
                                <td><?php echo $row2->speaking_test_point_pass; ?></td>
                                <td><?php echo tgl_f($row2->speaking_test_add); ?></td>
                                <td align="center">
                                    <span class="badge badge-info"><?php echo $this->db->get_where('speaking_sub_test', ['speaking_test_id' => $row2->speaking_test_id])->num_rows(); ?> question</span>
                                </td>
                                <td align="center">
                                    <a href="<?php echo base_url(); ?>teacher/test/speaking_get_from_practice/<?php echo $this->uri->segment(4); ?>/<?php echo $row2->speaking_test_id; ?>" class="btn btn-primary">Chosee</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>