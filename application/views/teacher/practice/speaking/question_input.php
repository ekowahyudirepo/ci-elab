<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/practice/speaking_question/<?php echo $this->uri->segment(4); ?>'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <b>Questions form input</b>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url(); ?>teacher/practice/speaking_question_add/<?php echo $this->uri->segment(4); ?>" method="post">
                <div class="row">
                    <div class="col-12">
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <textarea id="mymce" class="form-control" name="intro"></textarea>
                            <small class="text-muted">You can empty this field</small>
                        </div>

                        <!-- Block Question 1 -->
                        <div class="card ribbon-wrapper border">
                            <div class="ribbon ribbon-bookmark  ribbon-primary" id="1">Question</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Input Url Audio Question</label> &nbsp;&nbsp;<a href="#addquestion" data-toggle="modal">Add from media</a>
                                    <input id="urlquestion" type="url" class="form-control" name="question" required="">
                                </div>
                                <div class="form-group">
                                    <label>Input Url Audio Answer</label> &nbsp;&nbsp;<a href="#addanswer" data-toggle="modal">Add from media</a>
                                    <input id="urlanswer" type="url" class="form-control" name="answer" required="">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="number" min="1" class="form-control" name="point" placeholder="Point" required="">
                                </div>
                            </div>
                        </div>                  
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-success btn-lg"><i class="ti-save"></i> Save</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div id="addquestion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add media for question</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr align="center">
                            <th style="width: 50px;">No</th>
                            <th>Name</th>
                            <th>Play Audio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach($qw_audio->result() as $row2): ?>
                        <tr>
                            <td align="center"><?php echo $no++;  ?></td>
                            <td><?php echo $row2->media_name; ?></td>
                            <td>
                                <audio controls>
                                  <source src="<?php echo $row2->media_dir; ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                                </audio>
                            </td>
                            <td>
                                <button data-src="<?php echo $row2->media_dir; ?>" class="choseequestion btn btn-primary" data-dismiss="modal">Chosee</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div id="addanswer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add media for answer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr align="center">
                            <th style="width: 50px;">No</th>
                            <th>Name</th>
                            <th>Play Audio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach($qw_audio->result() as $row3): ?>
                        <tr>
                            <td align="center"><?php echo $no++;  ?></td>
                            <td><?php echo $row3->media_name; ?></td>
                            <td>
                                <audio controls>
                                  <source src="<?php echo $row3->media_dir; ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                                </audio>
                            </td>
                            <td>
                                <button data-src="<?php echo $row3->media_dir; ?>" class="choseeanswer btn btn-primary" data-dismiss="modal">Chosee</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        const choseequestion = $(".choseequestion");
        const urlquestion    = $("#urlquestion");

        choseequestion.on('click', function(){
            const src = $(this).data("src");

            urlquestion.val(src);
        });


        const choseeanswer = $(".choseeanswer");
        const urlanswer    = $("#urlanswer");

        choseeanswer.on('click', function(){
            const src = $(this).data("src");

            urlanswer.val(src);
        });
    })
</script>