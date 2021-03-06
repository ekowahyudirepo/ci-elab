<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Student</h4>
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
            <div class="card-body">
            	<button data-target="#create" data-toggle="modal" type="button" class="float-right btn waves-effect waves-light btn-info"><i class="ti-plus"></i> Create</button>
            	<div class="clearfix"></div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No.</th>
                                <th>NIM</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Password</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php $no = 1; ?>
                            <?php foreach( $qw_student->result() as $row ): ?>
    	                        <tr>
    	                            <td><?php echo $no++; ?></td>
    	                            <td><?php echo $row->student_no; ?></td>
                                    <td><?php echo $row->student_name; ?></td>
    	                            <td><?php echo $row->student_email; ?></td>
                                    <td>
                                        <?php if( $row->student_level == 'beginner' ): ?>
                                            <span class="badge badge-info">Beginner</span>
                                        <?php elseif( $row->student_level == 'intermediate' ): ?>
                                            <span class="badge badge-success">Intermediate</span>
                                        <?php elseif( $row->student_level == 'advanced' ): ?>
                                            <span class="badge badge-danger">Advanced</span>
                                        <?php else: ?>
                                            <span class="badge badge-dark">Not set</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo _jk($row->student_jk); ?></td>
                                    <td><?php echo $row->student_phone; ?></td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="right" data-original-title="Reset password. Default password to email" href="<?php echo base_url(); ?>admin/student/reset/<?php echo $row->student_id; ?>" class="btn btn-warning"><i class="ti-reload"></i></a>
                                    </td>
                                    <td>
                                        <?php if( $this->db->get_where('reading_answer', ['student_id' => $row->student_id ])->num_rows() ): ?>
                                        <?php elseif( $this->db->get_where('grammer_answer', ['student_id' => $row->student_id ])->num_rows() ): ?>
                                        <?php elseif( $this->db->get_where('listening_answer', ['student_id' => $row->student_id ])->num_rows() ): ?>
                                        <?php elseif( $this->db->get_where('speaking_answer', ['student_id' => $row->student_id ])->num_rows() ): ?>
                                        <?php else: ?>
                                            <a href="<?php echo base_url(); ?>admin/student/del/<?php echo $row->student_id; ?>" class="btn btn-danger"><i class="ti-trash"></i></a>
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


<!-- Modal Create -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create new student account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="<?php echo base_url() ?>admin/student/add" method="post" novalidate> 
            <div class="modal-body">
	    		<div class="form-group">
	                <label for="recipient-name" class="control-label">Email:</label>
	                <div class="controls">
	                <input type="email" class="form-control" name="email" required data-validation-required-message="This field is required">
	            	</div>
	            </div>
	            <div class="form-group">
	                <label for="message-text" class="control-label">NIM:</label>
	                <div class="controls">
	                <input type="text" class="form-control" name="no" required data-validation-required-message="This field is required">
	            	</div>
	            </div>
                <div class="form-group">
                    <label for="message-text" class="control-label">Name:</label>
                    <div class="controls">
                    <input type="text" class="form-control" name="name" required data-validation-required-message="This field is required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="message-text" class="control-label">Gender:</label>
                    <div class="controls">
                        <select class="form-control" name="jk" required="">
                            <option value="">--Choose--</option>
                            <option value="L">Male</option>
                            <option value="P">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message-text" class="control-label">Phone:</label>
                    <div class="controls">
                    <input type="text" class="form-control" name="phone" required data-validation-required-message="This field is required">
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
