<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>student/test'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
                    	<a href="?status=all" class="btn btn-<?php echo ($status == 'all')? 'outline-' : ''; ?>primary">All</a>
                    	<a href="?status=pending" class="btn btn-<?php echo ($status == 'pending')? 'outline-' : ''; ?>primary">Pending</a>
                    	<a href="?status=start" class="btn btn-<?php echo ($status == 'start')? 'outline-' : ''; ?>primary">Start</a>
                    	<a href="?status=finish" class="btn btn-<?php echo ($status == 'finish')? 'outline-' : ''; ?>primary">Finish</a>
                    	<div class="table-responsive">
	                        <table id="myTable" class="table table-bordered">
	                            <thead>
	                                <tr align="center">
	                                    <th style="width: 50px;">No</th>
	                                    <th>Name</th>
	                                    <th>Point to Pass</th>
	                                    <th>Your Point</th>
	                                    <th>Status Test</th>
	                                    <th>Date Start and Finish</th>
	                                    <th>Date add</th>
	                                    <th>Actions</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	<?php $no = 1; ?>
	                                <?php foreach($qw_listening_test->result() as $row): ?>
	                                <tr>
	                                    <td align="center"><?php echo $no++;  ?></td>
	                                    <td><?php echo $row->listening_test_name; ?></td>
	                                    <td><?php echo $row->listening_test_point_pass; ?></td>
	                                    <td align="center">
	                                    	
	                                    	<?php 

	                                    		if( $row->listening_test_status == 'finish' ) {

		                                    		$where = array(
		                                    			'listening_answer.student_id' => $this->session->userdata('__ci_studentid'), 
		                                    			'listening_answer.listening_test_id' => $row->listening_test_id, 
		                                    			'listening_answer.listening_answer_correct' => 'true' 
		                                    		);

		                                    		$test_point = $this->db->select_sum('listening_sub_test_point')->join('listening_answer','listening_answer.listening_sub_test_id = listening_sub_test.listening_sub_test_id')->get_where('listening_sub_test', $where )->row()->listening_sub_test_point;

		                                    		echo ($test_point == '')? '0' : $test_point;

		                                    	} else {

		                                    		echo "-";

		                                    	}

	                                    	 ?>
	                                    		
	                                    </td>
	                                    <td>
	                                    	<?php if( $row->listening_test_status == 'finish' ): ?>
		                                    	<?php if( $test_point >= $row->listening_test_point_pass ): ?>
		                                    		<span class="badge badge-success">Pass</span>
		                                    	<?php else: ?>
		                                    		<span class="badge badge-danger">Not Pass</span>
		                                    	<?php endif; ?>
	                                    	<?php else: ?>
	                                    		<span>-</span>
	                                    	<?php endif; ?>
	                                    </td>
	                                    <td>
	                                    	<?php echo tgl_f($row->listening_test_start); ?> (start)<br><?php echo tgl_f($row->listening_test_finish); ?> (finish)<br>
	                                    	<?php if( $row->listening_test_status == 'pending' ): ?>
	                                    		<span class="badge badge-info">Pending</span>
	                                    	<?php elseif( $row->listening_test_status == 'start' ): ?>
	                                    		<span class="badge badge-success">Start</span>
	                                    	<?php else: ?>
	                                    		<span class="badge badge-danger">Finish</span>
	                                    	<?php endif; ?>
	                                    </td>
	                                    <td><?php echo tgl_f($row->listening_test_add); ?></td>
	                                    <td align="center">
	                                    	<?php if( $row->listening_test_status == 'pending' ): ?>
	                                    		<span class="badge badge-info"><i class="ti-time"></i> Start at <?php echo tgl_f($row->listening_test_start); ?></span>
	                                    	<?php elseif( $row->listening_test_status == 'start' ): ?>
		                                    	<a href="<?php echo base_url(); ?>student/test/listening_question_view/<?php echo $row->listening_test_id; ?>" class="btn btn-primary"><i class="ti-eye"></i> Show test</a>
		                                    	<span class="badge badge-info"><?php echo $this->db->get_where('listening_sub_test', ['listening_test_id' => $row->listening_test_id])->num_rows(); ?> question</span>
		                                    <?php else: ?>
		                                    	<a href="<?php echo base_url(); ?>student/test/listening_answer_view/<?php echo $row->listening_test_id; ?>" class="btn btn-success"><i class="ti-info-alt"></i> Show result</a>
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