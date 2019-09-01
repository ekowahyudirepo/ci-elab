<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Library</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-white bg-primary">File Library</div>
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
                                        <th>Category</th>
                                        <th>Level</th>
                                        <th>Directory</th>
                                        <th>Date add</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($qw_library->result() as $row): ?>
                                    <tr>
                                        <td align="center"><?php echo $no++;  ?></td>
                                        <td><?php echo $row->library_name; ?></td>
                                        <td><?php echo $row->library_category; ?></td>
                                        <td><?php echo $row->library_level; ?></td>
                                        <td><a href="<?php echo $row->library_dir; ?>"><?php echo $row->library_dir; ?></td>
                                        <td><?php echo $row->library_add; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>teacher/library/del/<?php echo $row->library_id; ?>" class="btn btn-danger"><i class="ti-trash"></i></a>
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
    <div class="col-md-4">
        <div class="list-group">
            <a href="javascript:void(0)" class="list-group-item active">Filter Media by type</a> 
            <a href="<?php echo base_url(); ?>teacher/library/index/reading" class="list-group-item <?php echo ( $this->uri->segment(4) == 'reading' || $this->uri->segment(4) == '' )? 'active' : ''; ?>">Reading (<?php echo $qw_reading_num; ?>)</a> 
            <a href="<?php echo base_url(); ?>teacher/library/index/grammar" class="list-group-item <?php echo ( $this->uri->segment(4) == 'grammar' )? 'active' : ''; ?>">Grammar (<?php echo $qw_grammar_num; ?>)</a> 
            <a href="<?php echo base_url(); ?>teacher/library/index/listening" class="list-group-item <?php echo ( $this->uri->segment(4) == 'listening' )? 'active' : ''; ?>">Listening (<?php echo $qw_listening_num; ?>)</a> 
            <a href="<?php echo base_url(); ?>teacher/library/index/speaking" class="list-group-item <?php echo ( $this->uri->segment(4) == 'speaking' )? 'active' : ''; ?>">Speaking (<?php echo $qw_speaking_num; ?>)</a> 
        </div>
    </div>
</div>


<!-- Modal Create -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create new library</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="<?php echo base_url() ?>teacher/library/add/<?php echo ( $this->uri->segment(4) == '') ? 'reading ': $this->uri->segment(4); ?>" method="post" enctype="multipart/form-data" novalidate> 
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Name:</label>
                    <div class="controls">
                        <input type="text" class="form-control" name="name" required data-validation-required-message="This field is required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Level:</label>
                    <div class="controls">
                        <select class="form-control" name="level" required="">
                            <option value="">--Choose--</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Url:</label>
                    <div class="controls">
                        <input type="url" class="form-control" name="dir" required data-validation-required-message="This field is required">
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