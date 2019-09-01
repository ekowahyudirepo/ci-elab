<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/group'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
            <div class="card-header text-white bg-primary">Class</div>
            <div class="card-body">
            	<button data-target="#create" data-toggle="modal" type="button" class="float-right btn waves-effect waves-light btn-info"><i class="ti-plus"></i> Create</button>
            	<div class="clearfix"></div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No.</th>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Capacity</th>
                                <th>Remaining</th>
                                <th>Join Student</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php $no = 1; ?>
                            <?php foreach( $qw_kelas->result() as $row ): ?>
    	                        <tr>
    	                            <td><?php echo $no++; ?></td>
                                    <td><?php echo $row->kelas_name; ?></td>
                                    <td>
                                        <?php if( $row->kelas_level == 'beginner' ): ?>
                                            <span class="badge badge-info">Beginner</span>
                                        <?php elseif( $row->kelas_level == 'intermediate' ): ?>
                                            <span class="badge badge-success">Intermediate</span> 
                                        <?php else: ?>
                                            <span class="badge badge-danger">Advanced</span>
                                        <?php endif; ?>
                                    </td>
    	                            <td><?php echo $row->kelas_capacity; ?></td>
                                    <td>
                                        <?php echo $this->main->kelas_terisi($row->kelas_capacity, $row->kelas_id); ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>teacher/group/kelompok/<?php echo $row->kelas_id; ?>?level=<?php echo $row->kelas_level; ?>" class="btn btn-success">See</a>
                                    </td>
                                    <td>
                                        <?php if( $this->db->get_where('kelompok', ['kelas_id' => $row->kelas_id ])->num_rows() ): ?>
                                        <?php else: ?>
                                            <a href="<?php echo base_url(); ?>teacher/group/kelas_del/<?php echo $row->kelas_id; ?>" class="btn btn-danger"><i class="ti-trash"></i></a>
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
                <h4 class="modal-title">Create new class account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="<?php echo base_url() ?>teacher/group/kelas_add/<?php echo $this->uri->segment(4); ?>" method="post" novalidate> 
            <div class="modal-body">
	    		<div class="form-group">
	                <label for="recipient-name" class="control-label">Name:</label>
	                <div class="controls">
	                <input type="text" class="form-control" name="name" required data-validation-required-message="This field is required">
	            	</div>
	            </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">level:</label>
                    <div class="controls">
                    <select name="level" class="form-control">
                        <option value="">-- Chosee --</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                    </div>
                </div>
	            <div class="form-group">
	                <label for="message-text" class="control-label">Capacity:</label>
	                <div class="controls">
	                <input type="number" min="1" class="form-control" name="capacity" required data-validation-required-message="This field is required">
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
