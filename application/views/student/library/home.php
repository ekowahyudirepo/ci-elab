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
                                        <th>Actor</th>
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
                                        <td><?php echo $row->library_actor_name; ?></td>
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
            <a href="<?php echo base_url(); ?>student/library/index/reading" class="list-group-item <?php echo ( $this->uri->segment(4) == 'reading' || $this->uri->segment(4) == '' )? 'active' : ''; ?>">Reading (<?php echo $qw_reading_num; ?>)</a> 
            <a href="<?php echo base_url(); ?>student/library/index/grammar" class="list-group-item <?php echo ( $this->uri->segment(4) == 'grammar' )? 'active' : ''; ?>">Grammar (<?php echo $qw_grammar_num; ?>)</a> 
            <a href="<?php echo base_url(); ?>student/library/index/listening" class="list-group-item <?php echo ( $this->uri->segment(4) == 'listening' )? 'active' : ''; ?>">Listening (<?php echo $qw_listening_num; ?>)</a> 
            <a href="<?php echo base_url(); ?>student/library/index/speaking" class="list-group-item <?php echo ( $this->uri->segment(4) == 'speaking' )? 'active' : ''; ?>">Speaking (<?php echo $qw_speaking_num; ?>)</a> 
        </div>
    </div>
</div>
