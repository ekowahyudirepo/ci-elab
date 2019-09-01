<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/group/kelas/<?php echo $qw_periode_id; ?>'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<div class="row">
    <div class="col-md-12 mb-3"><h2>Student in <?php echo $this->input->get('level'); ?> class </h2></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <b>Student List</b>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <form class="form-inline" action="" method="get">
                            <input type="search" class="form-control" style="width: 300px;" name="keyword" required="" placeholder="NIM student" value="<?php echo $keyword; ?>">
                            <button class="btn btn-primary ml-2" type="submit"><i class="ti-search"></i> Filter to add</button>
                        </form>
                        <?php if( $this->input->get('keyword') ): ?>
                            <?php if( $qw_filter->num_rows() ): ?>
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr align="center">
                                                <th style="width: 50px;">No</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Gender</th>
                                                <th>Phone</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach($qw_filter->result() as $s): ?>
                                            <tr>
                                                <td align="center"><?php echo $no++;  ?></td>
                                                <td><?php echo $s->student_no; ?></td>
                                                <td><?php echo $s->student_name; ?></td>
                                                <td><?php echo _jk($s->student_jk); ?></td>
                                                <td><?php echo $s->student_phone; ?></td>
                                                <td align="center">
                                                    <a href="<?php echo base_url(); ?>teacher/group/kelompok_add/<?php echo $this->uri->segment(4); ?>/<?php echo $s->student_id; ?>" class="btn btn-primary"><i class="ti-plus"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="mt-3"><i class="ti-info-alt"></i> No found student data</p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="table-responsive mt-3">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr align="center">
                                        <th style="width: 50px;">No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Point Collected</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($qw_kelompok->result() as $row): ?>
                                    <tr>
                                        <td align="center"><?php echo $no++;  ?></td>
                                        <td><?php echo $row->student_no; ?></td>
                                        <td><?php echo $row->student_name; ?></td>
                                        <td><?php echo $row->student_phone; ?></td>
                                        <td><?php echo _jk($row->student_jk); ?></td>
                                        <td></td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>teacher/group/kelompok_del/<?php echo $row->student_id; ?>" class="btn btn-primary"><i class="ti-trash"></i></a>
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

