<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/practice'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
                    	<button data-target="#create" data-toggle="modal" type="button" class="float-right btn waves-effect waves-light btn-info"><i class="ti-plus"></i> Create</button>
                    	<div class="clearfix"></div>
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
	                                <?php foreach($qw_listening_test->result() as $row): ?>
	                                <tr>
	                                    <td align="center"><?php echo $no++;  ?></td>
	                                    <td><?php echo $row->listening_test_name; ?></td>
	                                    <td><?php echo $row->listening_test_point_pass; ?></td>
	                                    <td><?php echo tgl_f($row->listening_test_add); ?></td>
	                                    <td align="center">
	                                    	<a href="<?php echo base_url(); ?>teacher/practice/listening_question/<?php echo $row->listening_test_id; ?>" class="btn btn-primary"><i class="ti-eye"></i></a>
	                                    	<span class="badge badge-info"><?php echo $this->db->get_where('listening_sub_test', ['listening_test_id' => $row->listening_test_id])->num_rows(); ?> question</span>
	                                    </td>
	                                    <td align="center">
	                                    	<?php if( $this->db->get_where('listening_sub_test', ['listening_test_id' => $row->listening_test_id])->num_rows() ): ?>
	                                    	
	                                    	<?php else: ?>
		                                    	<a href="<?php echo base_url(); ?>teacher/practice/listening_del/<?php echo $row->listening_test_id; ?>" class="btn btn-danger"><i class="ti-trash"></i></a>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create new practice</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="<?php echo base_url() ?>teacher/practice/listening_add/<?php echo $this->uri->segment(4); ?>" method="post" novalidate> 
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Save changes</button>
            </div>
        	</form>
        </div>
    </div>
</div>