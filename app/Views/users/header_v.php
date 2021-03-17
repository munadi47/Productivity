<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    
     <!--Data Tables -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/b-1.6.5/b-html5-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.css"/>
    <!-- New Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
    <!--ICO-->
    <link rel="shortcut icon" type="image/jpg" href="<?php echo base_url('assets/img/favicon.ico');?>"/>
    <!--AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Font Awesome JS -->
    
    <script  src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script  src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
   
    <!--FullCalendar-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/FullCalendar.min.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/FullCalendar.css') ?>" />
    <script src="<?php echo base_url('assets/js/FullCalendar.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/FullCalendar.js') ?>"></script>
    

    <!--CK Editor-->
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    
    <!--HIGH CHART-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/gantt.js"></script>
    <script src="https://code.highcharts.com/modules/funnel.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    
    <!--Get Active Sidebar-->
    <?php
        $current_url = basename($_SERVER['PHP_SELF']);
        
        if($current_url == 'Dashboard'){
            $title = "Dashboard";
        }
        elseif($current_url == 'Client'){
            $title = "Client Data";
        }
        elseif ($current_url == 'Company'){
            $title = "Company Data";
        }
        elseif ($current_url == 'Consulting'){
            $title = "Consulting Delivery";
        }
        elseif ($current_url == 'Digital'){
            $title = "Digital Delivery";
        }
        elseif ($current_url == 'Employee'){
            $title = "Employee Data";
        }
        elseif ($current_url == 'Finance'){
            $title = "Finance Data";
        }
        elseif ($current_url == 'Learning'){
            $title = "Learning Delivery";
        }
        elseif ($current_url == 'Product'){
            $title = "Product Data";
        }
        elseif ($current_url == 'Register'){
            $title = "Register";
        }
        elseif ($current_url == 'SalesPipeline'){
            $title = "Sales Pipeline Data";
        }
        elseif ($current_url == 'Video'){
            $title = "Video Delivery";
        }
        elseif ($current_url == 'Attendance'){
            $title = "Attendance";
        }
        elseif ($current_url == 'Activity'){
            $title = "Activity Log";
        }
        elseif ($current_url == 'Video'){
            $title = "Video Delivery";
        }
        else{
            $title = "IDE Productivity";
        }
    ?>
    <title> <?php echo $title ; ?></title>
    <!--Daterangepicker -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
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
                <?php if(allow('admin')) : ?>
                <li>
                    <a href="<?php echo base_url('Dashboard')?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <?php endif; ?>

                <?php if(allow('user')) : ?>

                <li>
                    <a href="<?php echo base_url('Attendance')?>"><i class="fas fa-user-clock"></i> Attendance</a>
                </li>
                <?php endif; ?>

                <?php if(allow('admin')) : ?>
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
                <?php endif; ?>

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
                </li><?php if(allow('admin')) : ?>

                <li>
                    <a href="<?php echo base_url('Finance');?>"><i class="fas fa-money-bill"></i> Finance </a>
                </li>

                <li>
                    
                    <a href="#reportSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file"></i>  Report</a>
                    <ul class="collapse list-unstyled" id="reportSubmenu">
                        <li>
                            <a href="<?php echo base_url('Attendance/view')?>"><i class="fas fa-user-clock"></i> Report Attendance</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Activity')?>"><i class="fas fa-file-alt"></i> Activity Log</a>
                        </li>
                       
                        
                    </ul>
                </li><?php endif; ?>

               

              
               
                


                
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
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light " data-aos="fade-down" data-aos-duration="1000"
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
                                
                            <li class="nav-item">
                                <a class="nav-link" href="#"> 
                                    <button data-toggle="modal" data-target="#myModal" type="button" id="sidebarCollapse" class="btn btn-info">
                                        <i class="fas fa-user"></i> Profile
                                  
                                    </button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('Auth/logout'); ?>"> 
                                    <button type="button" id="sidebarCollapse" class="btn btn-danger">
                                        <i class="fas fa-sign-out-alt"></i> Log Out
                                  
                                    </button>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="modal fade" id="notifModal" role="dialog">
                        <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title"> <i class="fas fa-bell"></i> Notification</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                            </div>
                            <div class="modal-body">
                            <div class="activity-feed">
                            <?php if(!empty($deadlineStory)){ ?>
                                <?php foreach($deadlineStory as $row): {?>
                           
                                <div class="feed-item">
                                <div class="date"><?php echo $row->storyboard_date; ?></div>
                                <div class="text">Has due today <a href="single-need.php"> <?php echo $row->storyboard_pic; ?></a></div>
                                </div>
                            <?php } endforeach; ?>
                            <?php } ?>
                            <div class="feed-item">
                                <div class="date">Sep 24</div>
                                <div class="text">Added an interest “Volunteer Activities”</div>
                            </div>
                            <div class="feed-item">
                                <div class="date">Sep 23</div>
                                <div class="text">Joined the group <a href="single-group.php">“Boardsmanship Forum”</a></div>
                            </div>
                            <div class="feed-item">
                                <div class="date">Sep 21</div>
                                <div class="text">Responded to need <a href="single-need.php">“In-Kind Opportunity”</a></div>
                            </div>
                            <div class="feed-item">
                                <div class="date">Sep 18</div>
                                <div class="text">Created need <a href="single-need.php">“Volunteer Opportunity”</a></div>
                            </div>
                            <div class="feed-item">
                                <div class="date">Sep 17</div>
                                <div class="text">Attending the event <a href="single-event.php">“Some New Event”</a></div>
                            </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
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
                                                        <img src="<?php if(empty(session()->get('photo'))){
                                                            echo base_url('http://placehold.it/150x150');
                                                        }else{
                                                            echo base_url('assets/uploads/profile/'.session()->get('photo'));
                                                        } ?>" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                                        <div class="middle">
                                                            <a href="<?php echo base_url("Employee/editProfile/".session()->get('nik')); ?>">
                                                            <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="userData ml-3">
                                                        <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);"><?= session()->get('name') ?></a></h2>
                                                        <h6 class="d-block" style="font-size: 1.5rem; font-weight: "><a href="javascript:void(0);"><?= session()->get('level') ?></a></h6>

                                                      
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
                                                        
                                                    </ul>
                                                    <div class="tab-content ml-1" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                                            <div class="row">
                                                                <div class="col-sm-3 col-md-2 col-5">
                                                                    <label style="font-weight:bold;">NIK</label>
                                                                </div>
                                                                <div class="col-md-8 col-6">
                                                                <?= session()->get('nik') ?>
                                                                </div>
                                                            </div>
                                                            <hr />

                                                            <div class="row">
                                                                <div class="col-sm-3 col-md-2 col-5">
                                                                    <label style="font-weight:bold;">Address</label>
                                                                </div>
                                                                <div class="col-md-8 col-6">
                                                                <?= session()->get('address') ?>
                                                                </div>
                                                            </div>
                                                            <hr />

                                                            <div class="row">
                                                                <div class="col-sm-3 col-md-2 col-5">
                                                                    <label style="font-weight:bold;">Birth Date</label>
                                                                </div>
                                                                <div class="col-md-8 col-6">
                                                                <?= session()->get('birthday') ?>
                                                                </div>
                                                            </div>
                                                            <hr />

                                                            <div class="row">
                                                                <div class="col-sm-3 col-md-2 col-5">
                                                                    <label style="font-weight:bold;">Email</label>
                                                                </div>
                                                                <div class="col-md-8 col-6">
                                                                <?= session()->get('email') ?>
                                                                </div>
                                                            </div>
                                                            <hr />

                                                         

                                                            <div class="row">
                                                                <div class="col-sm-3 col-md-2 col-5">
                                                                    <label style="font-weight:bold;">Phone</label>
                                                                </div>
                                                                <div class="col-md-8 col-6">
                                                                <?= session()->get('phone1') ?>
                                                                </div>
                                                            </div>
                                                            
                                                            <?php if(!empty(session()->get('phone2'))){?>
                                                            <hr />
                                                            <div class="row">
                                                                <div class="col-sm-3 col-md-2 col-5">
                                                                    <label style="font-weight:bold;">Phone2</label>
                                                                </div>
                                                                <div class="col-md-8 col-6">
                                                                    <?= session()->get('phone2') ?>
                                                                </div>
                                                            </div>
                                                            <?php } ?>
                                                            <hr />
                                                            <div class="row">
                                                                <div class="col-lg-5 col-md-6 col-8">
                                                                    <label style="font-weight:bold; ">Status Attendance</label>
                                                                </div>
                                                                <!--Di update jika ada perubahan -->
                                                                <div class="col-lg-3 col-3">
                                                                
                                                                <?php if(!empty($dataAttendance)){ ?>
                                                                    <?php foreach ($dataAttendance as $row):{?>
                                                                    <?php if($row->jumlah < 3 ){?>
                                                                        <?php echo "<span class='badge badge-warning'>Not Fulfilled</span>"?>

                                                                    <?php }else {
                                                                        echo "<span class='badge badge-success'>Fulfilled</span>";
                                                                }
                                                                }endforeach;
                                                                ?>
                                                                
                                                                <?php } else {?> <span class='badge badge-warning'>Not Fulfilled</span><?php }?>

                                                                

                                                                </div>
                                                            </div>
                                                            <hr />
                                                            
                                                            
                                                            

                                                        </div>
                                                        <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                                           Coming soon
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
                                <a href="<?php echo base_url("Employee/editProfile/".session()->get('nik')); ?>"> 
                                    <button  type="button" class="btn btn-info">
                                        <i class="fas fa-user"></i> Edit
                                    </button>
                                </a>

                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                
                            </div>
                        </div>
                    </div>
	                </div>
                </div>
            </nav>




            