<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/test/listening/<?php echo $test->listening_test_level; ?>'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <b>Test</b>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <?php if( $test->listening_test_status == 'new' OR $test->listening_test_status == 'pending' ): ?>
                            <button data-target="#create" data-toggle="modal" type="button" class="float-right btn waves-effect waves-light btn-info"><i class="ti-plus"></i> Add</button>
                            <div class="clearfix"></div>
                        <?php endif; ?>
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr align="center">
                                    <th style="width: 50px;">No</th>
                                    <th>Name</th>
                                    <th>Point</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($qw_student->result() as $row): ?>
                                <tr>
                                    <td align="center"><?php echo $no++;  ?></td>
                                    <td><?php echo $row->student_name; ?></td>
                                    <td align="center">
                                        <?php $point = $this->main->student_table_point('listening', $row->student_id); 
                                            echo $point;
                                        ?>
                                        <br>
                                        <?php if( $point >= $test->listening_test_point_pass ): ?>
                                            <span class="badge badge-success">Pass</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Not Pass</span>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center">
                                        <a href="<?php echo base_url(); ?>teacher/test/listening_student_view/<?php echo $this->uri->segment(4); ?>/<?php echo $row->student_id; ?>" class="btn btn-primary"><i class="ti-eye"></i></a>
                                        <?php if( $test->listening_test_status == 'new' OR $test->listening_test_status == 'pending' ){ ?>
                                            <a href="<?php echo base_url(); ?>teacher/test/listening_student_del/<?php echo $this->uri->segment(4); ?>/<?php echo $row->student_id; ?>" class="btn btn-danger"><i class="ti-trash"></i></a>
                                        <?php } ?>
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
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <b>Pie</b>
            </div>
            <div class="card-body">
                <div id="container"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add student</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="<?php echo base_url() ?>teacher/test/listening_student_add/<?php echo $this->uri->segment(4); ?>" method="post" novalidate> 
            <div class="modal-body">
                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr align="center">
                            <th style="width: 50px;"></th>
                            <th style="width: 50px;">No</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach($qw_student2->result() as $row2): ?>
                        <?php if( ! in_array($row2->student_id, $qw_student_id) ): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="student_id[]" value="<?php echo $row2->student_id; ?>" class="check" id="flat-checkbox-1" data-checkbox="icheckbox_flat-red">
                            </td>
                            <td align="center"><?php echo $no++;  ?></td>
                            <td><?php echo $row2->student_name; ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
  Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.0f} %</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.0f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Pie',
        colorByPoint: true,
        data: [{
            name: 'Pass',
            y: <?php echo $qw_pass; ?>,
            sliced: true,
            selected: true
        }, {
            name: 'Not Pass',
            y: <?php echo $qw_not_pass; ?>
        }]
    }]
});
</script>