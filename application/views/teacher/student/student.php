<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/student'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
    <div class="col-md-12 mb-3"><h2>Student in <?php echo $this->uri->segment(3); ?> class </h2></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <b>Student List</b>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr align="center">
                                        <th style="width: 50px;">No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Point Collected</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($qw_student->result() as $row): ?>
                                    <tr>
                                        <td align="center"><?php echo $no++;  ?></td>
                                        <td><?php echo $row->student_no; ?></td>
                                        <td><?php echo $row->student_name; ?></td>
                                        <td><?php echo $row->student_phone; ?></td>
                                        <td><?php echo $row->student_email; ?></td>
                                        <td><?php echo _jk($row->student_jk); ?></td>
                                        <td align="center"><?php echo $this->main->student_point( $row->student_id ); ?></td>
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

