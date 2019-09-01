<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Periode</h4>
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
                                <th>Name</th>
                                <th>Year</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php $no = 1; ?>
                            <?php foreach( $qw_periode->result() as $row ): ?>
    	                        <tr>
    	                            <td><?php echo $no++; ?></td>
                                    <td><?php echo $row->periode_name; ?></td>
    	                            <td><?php echo $row->periode_year; ?></td>
                                    <td><?php echo $row->periode_note; ?></td>
                                    <td>
                                        <?php if( $row->periode_status == 'archive' ): ?>
                                            <span class="badge badge-info">Archive</span>
                                        <?php elseif( $row->periode_status == 'open' ): ?>
                                            <span class="badge badge-success">Open</span>
                                        <?php elseif( $row->periode_status == 'close' ): ?>
                                            <span class="badge badge-danger">Close</span>
                                        <?php else: ?>
                                            <span class="badge badge-dark">New</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if( $row->periode_status == 'new' ): ?>
                                            <a href="<?php echo base_url(); ?>admin/periode/update_status/<?php echo $row->periode_id; ?>?status=open" class="btn btn-success">Open</a>
                                        <?php elseif( $row->periode_status == 'open' ): ?>
                                            <a href="<?php echo base_url(); ?>admin/periode/update_status/<?php echo $row->periode_id; ?>?status=close" class="btn btn-danger">Close</a>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if( $this->db->get_where('kelas', ['periode_id' => $row->periode_id ])->num_rows() ): ?>
                                        <?php else: ?>
                                            <a href="<?php echo base_url(); ?>admin/periode/del/<?php echo $row->periode_id; ?>" class="btn btn-danger"><i class="ti-trash"></i></a>
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
                <h4 class="modal-title">Create new periode account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="<?php echo base_url() ?>admin/periode/add" method="post" novalidate> 
            <div class="modal-body">
	    		<div class="form-group">
	                <label for="recipient-name" class="control-label">Name:</label>
	                <div class="controls">
	                <input type="text" class="form-control" name="name" required data-validation-required-message="This field is required">
	            	</div>
	            </div>
	            <div class="form-group">
	                <label for="message-text" class="control-label">Year:</label>
	                <div class="controls">
	                <input type="text" class="form-control" name="year" required data-validation-required-message="This field is required">
	            	</div>
	            </div>
                <div class="form-group">
                    <label for="message-text" class="control-label">Note:</label>
                    <div class="controls">
                    <textarea class="form-control" name="note"></textarea>
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
