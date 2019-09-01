<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>student/practice'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                    	<div class="table-responsive">
	                        <table id="myTable" class="table table-bordered">
	                            <thead>
	                                <tr align="center">
	                                    <th style="width: 50px;">No</th>
	                                    <th>Name</th>
	                                    <th>Point to Pass</th>
	                                    <th>Date add</th>
	                                    <th>Question</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	<?php $no = 1; ?>
	                                <?php foreach($qw_listening_test->result() as $row): ?>
	                                <tr>
	                                    <td align="center"><?php echo $no++;  ?></td>
	                                    <td><?php echo $row->listening_test_name; ?></td>
	                                    <td><?php echo $row->listening_test_point_pass; ?></td>
	                                    <td><?php echo tgl_f($row->listening_test_add); ?></td>
	                                    <td align="center">
	                                    	<a href="<?php echo base_url(); ?>student/practice/listening_question_view/<?php echo $row->listening_test_id; ?>" class="btn btn-primary"><i class="ti-eye"></i></a>
	                                    	<span class="badge badge-info"><?php echo $this->db->get_where('listening_sub_test', ['listening_test_id' => $row->listening_test_id])->num_rows(); ?> question</span>
	                                    </td>
	                                </tr>
	                            <?php endforeach; ?>
	                            </tbody>
	                        </table>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>