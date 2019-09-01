<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/test'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
                <b>Test</b>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                    	<a href="?status=all" class="btn btn-<?php echo ($status == 'all')? 'outline-' : ''; ?>primary">All</a>
                    	<a href="?status=new" class="btn btn-<?php echo ($status == 'new')? 'outline-' : ''; ?>primary">New</a>
                    	<a href="?status=pending" class="btn btn-<?php echo ($status == 'pending')? 'outline-' : ''; ?>primary">Pending</a>
                    	<a href="?status=start" class="btn btn-<?php echo ($status == 'start')? 'outline-' : ''; ?>primary">Start</a>
                    	<a href="?status=finish" class="btn btn-<?php echo ($status == 'finish')? 'outline-' : ''; ?>primary">Finish</a>
                    	<button data-target="#create" data-toggle="modal" type="button" class="float-right btn waves-effect waves-light btn-info"><i class="ti-plus"></i> Create</button>
                    	<div class="clearfix"></div>
                    	<div class="table-responsive">
	                        <table id="myTable" class="table table-bordered">
	                            <thead>
	                                <tr align="center">
	                                    <th style="width: 50px;">No</th>
	                                    <th>Name</th>
	                                    <th>Point to Pass</th>
	                                    <th>Date Start and Finish</th>
	                                    <th>Date add</th>
	                                    <th>Question</th>
	                                    <th>Student</th>
	                                    <th></th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	<?php $no = 1; ?>
	                                <?php foreach($qw_reading_test->result() as $row): ?>
	                                <tr>
	                                    <td align="center"><?php echo $no++;  ?></td>
	                                    <td>
	                                    	<?php echo $row->reading_test_name; ?>
	                                    	<br>
	                                    	<br>
	                                    	<a href="<?php echo base_url(); ?>teacher/test/reading_police/<?php echo $row->reading_test_id; ?>"><i class="ti-receipt"></i> Update Policy</a>	
	                                    </td>
	                                    <td><?php echo $row->reading_test_point_pass; ?></td>
	                                    <td>
	                                    	<?php echo tgl_f($row->reading_test_start); ?> (start)<br><?php echo tgl_f($row->reading_test_finish); ?> (finish)<br>
	                                    	<?php if( $row->reading_test_status == 'pending' ): ?>
	                                    		<span class="badge badge-info">Pending</span>
	                                    	<?php elseif( $row->reading_test_status == 'start' ): ?>
	                                    		<span class="badge badge-success">Start</span>
	                                    	<?php elseif( $row->reading_test_status == 'finish' ): ?>
	                                    		<span class="badge badge-danger">Finish</span>
	                                    	<?php else: ?>
	                                    		<span class="badge badge-dark">New</span>
	                                    	<?php endif; ?>
	                                    </td>
	                                    <td><?php echo tgl_f($row->reading_test_add); ?></td>
	                                    <td align="center">
	                                    	<a href="<?php echo base_url(); ?>teacher/test/reading_question/<?php echo $row->reading_test_id; ?>" class="btn btn-primary"><i class="ti-eye"></i></a>
	                                    	<br>
	                                    	<span class="badge badge-info"><?php echo $this->db->get_where('reading_sub_test', ['reading_test_id' => $row->reading_test_id])->num_rows(); ?> question</span>
	                                    </td>
	                                    <td align="center">
	                                    	<a href="<?php echo base_url(); ?>teacher/test/reading_student/<?php echo $row->reading_test_id; ?>" class="btn btn-info"><i class="ti-eye"></i></a>
	                                    	<br>
	                                    	<span class="badge badge-info"><?php echo $this->db->group_by('student_id')->get_where('reading_answer', ['reading_test_id' => $row->reading_test_id])->num_rows(); ?> student</span>
	                                    </td>
	                                    <td align="center">
	                                    	<?php if( $this->db->get_where('reading_sub_test', ['reading_test_id' => $row->reading_test_id])->num_rows() ): ?>
		                                    	<?php if( $row->reading_test_status == 'new' ): ?>
		                                    		<a href="<?php echo base_url(); ?>teacher/test/reading_play/<?php echo $row->reading_test_id; ?>" class="btn btn-success"><i class="ti-control-play"></i></a>
		                                    	<?php endif; ?>
	                                    	<?php else: ?>
		                                    	<a href="<?php echo base_url(); ?>teacher/test/reading_del/<?php echo $row->reading_test_id; ?>" class="btn btn-danger"><i class="ti-trash"></i></a>
		                                    <?php endif; ?>
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

<!-- Modal Create -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create new test</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="<?php echo base_url() ?>teacher/test/reading_add/<?php echo $this->uri->segment(4); ?>" method="post" novalidate> 
            <div class="modal-body">
	    		<div class="form-group">
	                <label for="recipient-name" class="control-label">Name:</label>
	                <div class="controls">
	                <input type="text" class="form-control" name="name" required data-validation-required-message="This field is required">
	            	</div>
	            </div>
	            <div class="form-group">
	                <label for="recipient-name" class="control-label">Point to Pass:</label>
	                <div class="controls">
	                <input type="number" min="1" class="form-control" name="point" required data-validation-required-message="This field is required">
	            	</div>
	            </div>
	            <div class="form-group">
	                <label for="recipient-name" class="control-label">Start at:</label>
	                <div class="controls">
	                <input type="date" min="1" class="form-control" name="start" required data-validation-required-message="This field is required">
	            	</div>
	            </div>
	            <div class="row">
		            <div class="form-group col-6">
		                <label for="recipient-name" class="control-label">Time:</label>
		                <div class="controls">
		                	<input type="time" min="1" class="form-control" name="time" required data-validation-required-message="This field is required">
		            	</div>
		            </div>
		            <div class="form-group col-6">
		                <label for="recipient-name" class="control-label">Duration:</label>
		                <div class="controls">
		                	<input type="number" min="1" class="form-control" name="duration" required data-validation-required-message="This field is required">
		            	</div>
		            </div>
		        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Save changes</button>
            </div>
        	</form>
        </div>
    </div>
</div>