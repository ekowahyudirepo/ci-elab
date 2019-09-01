<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <title><?php echo $title; ?></title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet">
    <!-- Icheck -->
    <link href="<?php echo base_url(); ?>assets/node_modules/icheck/skins/all.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/dist/css/pages/form-icheck.css" rel="stylesheet">

    <!-- dropify -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/node_modules/dropify/dist/css/dropify.min.css">
    <script src="<?php echo base_url(); ?>assets/node_modules/jquery/jquery-3.2.1.min.js"></script>

</head>

<body class="skin-megna fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Learning App</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img style="width: 70px;" src="<?php echo base_url(); ?>assets/logo.png" alt="homepage" class="dark-logo ml-2" />
                            <!-- Light Logo icon -->
                            <img style="width: 70px;" src="<?php echo base_url(); ?>assets/logo.png" alt="homepage" class="light-logo ml-2" />
                        </b>
                        <!--End Logo icon -->
                        <!-- <span class="hidden-xs"><span class="font-bold"><img style="width: 50px;" src="<?php //echo base_url(); ?>assets/logo.png" class="img-fluid"></span></span> -->
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <li class="nav-item"> <a onclick="openFullscreen()" class="nav-link  waves-effect waves-light" href="#"><i class="ti-fullscreen"></i> Full Screen</a></li>
                        <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-pro"> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <img src="<?php echo base_url(); ?>assets/images/users/1.jpg" alt="user-img" class="img-circle">
                                <b>Hi, <?php echo substr($this->session->userdata('__ci_adminname'),0,10); ?></b><br>
                                <span class="badge badge-info float-left mt-2">Administor</span>
                                <div class="clearfix"></div>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>admin/profil"><i class="ti-user"></i> Profil</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="<?php echo base_url() ?>admin/dashboard"><i class="ti-layout-grid2"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">Users Account</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url() ?>admin/teacher">Teacher</a></li>
                                <li><a href="<?php echo base_url() ?>admin/student">Student</a></li>
                                <li><a href="<?php echo base_url() ?>admin/contributor">Contributor</a></li>
                            </ul>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="<?php echo base_url() ?>admin/periode"><i class="ti-timer"></i><span class="hide-menu">Periode</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                

                <?php echo $inc; ?>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme">4</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme working">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2018 Eliteadmin by themedesigner.in
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/node_modules/popper/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url(); ?>assets/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url(); ?>assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url(); ?>assets/dist/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url(); ?>assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo base_url(); ?>assets/node_modules/icheck/icheck.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/node_modules/icheck/icheck.init.js"></script>
    <!-- Dropify -->
    <!-- jQuery file upload -->
    <script src="<?php echo base_url(); ?>assets/node_modules/dropify/dist/js/dropify.min.js"></script>

    <!-- This is data table -->
    <script src="<?php echo base_url(); ?>assets/node_modules/datatables/jquery.dataTables.min.js"></script>

    <!--Custom JavaScript -->
    <script src="<?php echo base_url(); ?>assets/dist/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/pages/validation.js"></script>
    <script>
        $(function(){
            $('#myTable').DataTable();
            $('.dropify').dropify();
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        });


        var elem = document.documentElement;

        /* View in fullscreen */
        function openFullscreen() {
          if (elem.requestFullscreen) {
            elem.requestFullscreen();
          } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
          } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
            elem.webkitRequestFullscreen();
          } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
          }
        }
    </script>
</body>

</html>