<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/test/grammer_question/<?php echo $this->uri->segment(4); ?>'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
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
                <form action="<?php echo base_url(); ?>teacher/test/grammer_question_add/<?php echo $this->uri->segment(4); ?>" method="post">
                <div class="row">
                    <div class="col-12">
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <div class="col-12">
                        <!-- Block Question 1 -->
                        <div class="card ribbon-wrapper border">
                            <div class="ribbon ribbon-bookmark  ribbon-primary" id="1">Question</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Input Question</label>
                                    <input type="text" class="form-control" name="question" required="">
                                </div>
                                <label>Input Answer</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="a" placeholder="Answer A." required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="b" placeholder="Answer B." required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="c" placeholder="Answer C." required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="d" placeholder="Answer D." required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-success">
                                            <select class="form-control selectpicker" data-style="btn-primary" name="answer" required="">
                                                <option value="">--Choose correct Answer--</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" min="1" class="form-control" name="point" placeholder="Point" required="">
                                        </div>
                                    </div>
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

