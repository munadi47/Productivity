<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>IDE Productivity</title>
     <!--Data Tables -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/b-1.6.5/b-html5-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.css"/>
    <!-- New Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
    <!--ICO-->
    <link rel="shortcut icon" type="image/jpg" href="<?php echo base_url('assets/img/favicon.ico');?>"/>
    <!--AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Font Awesome JS -->
    <script  src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script  src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    
    <!--HIGH CHART-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/gantt.js"></script>
    <script src="https://code.highcharts.com/modules/funnel.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!-- Filepond -->
     <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
   

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a class="navbar-brand" href="#">
                    <img src="<?php echo base_url('assets/img/LOGO IDE.png'); ?>" width="114" height="66" class="d-inline-block align-top" alt="">
                    
                  </a>
            </div>

            <ul class="list-unstyled components">
                
                <li>
                    <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-user-clock"></i> Attendance</a>
                </li>
                <li>
                    <a href="#masterSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-table"></i> Company Data</a>
                    <ul class="collapse list-unstyled" id="masterSubmenu">
                        <li>
                            <a href="<?php echo base_url('Employee')?>"><i class="fas fa-user-tie"></i> Employee </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Company')?>"><i class="fas fa-building"></i> Company </a>
                        </li>
                       
                    </ul>
                </li>
               
                <li >
                    
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-filter"></i>  Sales Pipeline</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="<?php echo base_url('Client')?>"><i class="fas fa-users"></i> Client</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Product')?>"><i class="fas fa-box"></i> Product</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('SalesPipeline')?>"><i class="fas fa-chart-line"></i> Pipeline</a>
                        </li>
                        
                    </ul>
                </li>
                
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-truck-loading"></i> Delivery</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="<?php echo base_url('Video');?>"><i class="fas fa-video"></i> Video</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Digital');?>"><i class="fas fa-desktop"></i> Digital Content</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Learning');?>"><i class="fas fa-graduation-cap"></i> Learning</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Consulting');?>"><i class="fas fa-chalkboard-teacher"></i> Consulting</a>
                        </li>
                       
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url('Finance');?>"><i class="fas fa-money-bill"></i> Finance </a>
                </li>

                <li>
                    
                    <a href="#reportSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file"></i>  Report</a>
                    <ul class="collapse list-unstyled" id="reportSubmenu">
                        <li>
                            <a href="<?php echo base_url('Report_Attendance')?>"><i class="fas fa-user-clock"></i> Report Attendance</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Activity Log')?>"><i class="fas fa-file-alt"></i> Activity Log</a>
                        </li>
                       
                        
                    </ul>
                </li>
               

              
               
                


                
            </ul>

            

            <ul class="list-unstyled CTAs">
                
              
                
                <li>
                    <a href="#" class="article"><i class="fas fa-exclamation-circle"></i> About Application</a>
                </li>
                
                <li>
                    <p class="version">Version 1.0</p>
                    <!--<a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>-->
                </li>
                
                
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light" data-aos="fade-down" data-aos-duration="1000"
            data-aos-easing="ease-in-out">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                      
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#"> 
                                    <button data-toggle="modal" data-target="#myModal" type="button" id="sidebarCollapse" class="btn btn-info">
                                        <i class="fas fa-user"></i> Profile
                                  
                                    </button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login_v.html"> 
                                    <button type="button" id="sidebarCollapse" class="btn btn-danger">
                                        <i class="fas fa-sign-out-alt"></i> Log Out
                                  
                                    </button>
                                </a>
                            </li>
                            
                        </ul>
                    </div>

                    <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- konten modal-->
                        <div class="modal-content">
                            <!-- heading modal -->
                            <div class="modal-header">
                                
                                <h4 class="modal-title">Profile</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- body modal -->
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="card-title mb-4">
                                                <div class="d-flex justify-content-start">
                                                    <div class="image-container">
                                                        <img src="http://placehold.it/150x150" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                                        <div class="middle">
                                                            <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                                            <input type="file" style="display: none;" id="profilePicture" name="file" />
                                                        </div>
                                                    </div>
                                                    <div class="userData ml-3">
                                                        <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">Some Name</a></h2>
                                                        <h6 class="d-block"><a href="javascript:void(0)"></a> Video Editor</h6>
                                                    
                                                    <div class="ml-auto">
                                                        <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Connected Services</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content ml-1" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                                            

                                                            <div class="row">
                                                                <div class="col-sm-3 col-md-2 col-5">
                                                                    <label style="font-weight:bold;">Address</label>
                                                                </div>
                                                                <div class="col-md-8 col-6">
                                                                    Jakarta Utara
                                                                </div>
                                                            </div>
                                                            <hr />

                                                            <div class="row">
                                                                <div class="col-sm-3 col-md-2 col-5">
                                                                    <label style="font-weight:bold;">Birth Date</label>
                                                                </div>
                                                                <div class="col-md-8 col-6">
                                                                    March 22, 1994.
                                                                </div>
                                                            </div>
                                                            <hr />
                                                            
                                                            
                                                            

                                                        </div>
                                                        <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                                            Facebook, Google, Twitter Account that are connected to this account
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- footer modal -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
	</div>
                </div>
            </nav>




            