<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <!-- <h4 class="text-themecolor">Dashboard</h4> -->
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active">Home</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="display-1 text-warning">
                            <?php if( $this->session->userdata('__ci_studentlevel') == 'beginner' ): ?>
                                <i class="ti-medall"></i>
                            <?php elseif( $this->session->userdata('__ci_studentlevel') == 'intermediate' ): ?>
                                <i class="ti-medall"></i><i class="ti-medall"></i>
                            <?php else: ?>
                                <i class="ti-medall"></i><i class="ti-medall"></i><i class="ti-medall"></i>
                            <?php endif; ?>
                        </h1>
                        <h4>My level is <u><?php echo $this->session->userdata('__ci_studentlevel'); ?></u></h4>
                        <h1 class="text-success"> <?php echo $student_point; ?> Point</h1>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <h4>Point in aech level</h4>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-4 bg-info text-white p-3">
                        <i class="ti-medall-alt"></i>
                        <h4>Beginner</h4>
                        <p>100</p>
                    </div>
                    <div class="col-md-4 bg-success text-white p-3">
                        <i class="ti-medall"></i><i class="ti-medall"></i>
                        <h4>Intermediate</h4>
                        <p>1000</p>
                    </div>
                    <div class="col-md-4 bg-danger text-white p-3">
                        <i class="ti-medall"></i><i class="ti-medall"></i><i class="ti-medall"></i>
                        <h4>Advanced</h4>
                        <p>10000</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body b-l calender-sidebar">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<script>

        var defaultEvents =  <?php echo json_encode($qw_jadwal) ?>;

        $("#calendar").fullCalendar({
            slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
            minTime: '08:00:00',
            maxTime: '19:00:00',  
            defaultView: 'month',  
            handleWindowResize: true,   
             
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: defaultEvents,
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            eventLimit: true, // allow "more" link when too many events
            selectable: true

        });
    </script>