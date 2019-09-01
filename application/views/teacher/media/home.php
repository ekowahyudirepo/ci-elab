<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Media</h4>
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
            <div class="card-header text-white bg-primary">File Media</div>
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
                                        <th>Directory</th>
                                        <th>Date add</th>
                                        <th>Play Audio </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($qw_media->result() as $row): ?>
                                    <tr>
                                        <td align="center"><?php echo $no++;  ?></td>
                                        <td><?php echo $row->media_name; ?></td>
                                        <td><a href="<?php echo $row->media_dir; ?>"><?php echo $row->media_dir; ?></td>
                                        <td><?php echo tgl_f($row->media_add); ?></td>
                                        <td>                                            
                                            <?php if( $this->uri->segment(4) == 'audio' ): ?>
                                                <audio controls>
                                                  <source src="<?php echo $row->media_dir; ?>" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                                </audio>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>teacher/media/del/<?php echo $row->media_id; ?>" class="btn btn-danger"><i class="ti-trash"></i></a>
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
            <a href="<?php echo base_url(); ?>teacher/media/index/image" class="list-group-item <?php echo ( $this->uri->segment(4) == 'image' || $this->uri->segment(4) == '' )? 'active' : ''; ?>">Image (<?php echo $qw_image_num; ?>)</a> 
            <a href="<?php echo base_url(); ?>teacher/media/index/audio" class="list-group-item <?php echo ( $this->uri->segment(4) == 'audio' )? 'active' : ''; ?>">Audio (<?php echo $qw_audio_num; ?>)</a> 
            <a href="<?php echo base_url(); ?>teacher/media/index/doc" class="list-group-item <?php echo ( $this->uri->segment(4) == 'doc' )? 'active' : ''; ?>">Doc (<?php echo $qw_doc_num; ?>)</a> 
            <a href="<?php echo base_url(); ?>teacher/media/index/xls" class="list-group-item <?php echo ( $this->uri->segment(4) == 'xls' )? 'active' : ''; ?>">Excel (<?php echo $qw_xls_num; ?>)</a> 
            <a href="<?php echo base_url(); ?>teacher/media/index/pdf" class="list-group-item <?php echo ( $this->uri->segment(4) == 'pdf' )? 'active' : ''; ?>">Pdf (<?php echo $qw_pdf_num; ?>)</a>
            <a href="<?php echo base_url(); ?>teacher/media/index/zip" class="list-group-item <?php echo ( $this->uri->segment(4) == 'zip' )? 'active' : ''; ?>">Zip (<?php echo $qw_zip_num; ?>)</a>
        </div>
    </div>
</div>


<!-- Modal Create -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create new media</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="<?php echo base_url() ?>teacher/media/add/<?php echo ( $this->uri->segment(4) == '') ? 'image ': $this->uri->segment(4); ?>" method="post" enctype="multipart/form-data" novalidate> 
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Name:</label>
                    <div class="controls">
                    <input type="text" class="form-control" name="name" required data-validation-required-message="This field is required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Drop your file here:</label>
                    <div class="controls">
                        <?php if( $this->uri->segment(4) == 'pdf' ): ?>
                            <input accept="application/pdf" type="file" id="input-file-now" name="file" class="dropify" />
                        <?php elseif( $this->uri->segment(4) == 'image' || $this->uri->segment(4) == '' ): ?>
                            <input accept="image/*" type="file" id="input-file-now" name="file" class="dropify" />
                        <?php elseif( $this->uri->segment(4) == 'doc' ): ?>
                            <input accept="application/msword" type="file" id="input-file-now" name="file" class="dropify" />
                        <?php elseif( $this->uri->segment(4) == 'xls' ): ?>
                            <input accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" type="file" id="input-file-now" name="file" class="dropify" />
                        <?php elseif( $this->uri->segment(4) == 'audio' ): ?>
                            <input accept=".mp3" type="file" id="input-file-now" name="file" class="dropify" />
                        <?php elseif( $this->uri->segment(4) == 'zip' ): ?>
                            <input accept=".zip" type="file" id="input-file-now" name="file" class="dropify" />
                        <?php else: ?>
                            <div class="alert alert-danger">Type file not allow</div>
                        <?php endif; ?>
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