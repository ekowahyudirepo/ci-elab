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
            <div class="card-header text-white bg-primary">Periode</div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <form method="get" class="float-right form-inline">
                            <input type="text" class="form-control" name="periode" placeholder="Periode year">
                            <button type="submit" class="ml-2 btn waves-effect waves-light btn-info"><i class="ti-search"></i> Filter</button>
                        </form>
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
                                                <?php if( $row->periode_status == 'open' ): ?>
                                                    <a href="<?php echo base_url(); ?>teacher/group/kelas/<?php echo $row->periode_id; ?>" class="btn btn-primary">Make Class</a>
                                                <?php else: ?>
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