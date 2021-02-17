<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>IDE Productivity</title>
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css" integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous"/>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a class="navbar-brand" href="#">
                    <img src="<?php echo base_url('assets/img/LOGO IDE.png');?>" width="114" height="66" class="d-inline-block align-top" alt="">
                    
                  </a>
            </div>

            <ul class="list-unstyled components">
               
                <li>
                    <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                
               <li>
                <a href="#"><i class="fas fa-table"></i> Master Data</a>
            
               </li>
               <li>
                <a href="#"><i class="fas fa-chart-line"></i> Sales Pipeline</a>
                </li>
                
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-truck-loading"></i> Delivery</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#"><i class="fas fa-video"></i> Video</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-desktop"></i> Digital Content</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-graduation-cap"></i> Learning</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-chalkboard-teacher"></i> Consulting</a>
                        </li>
                    </ul>
                </li>
               
                <li class="active">
                    
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file-alt"></i> Report</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#"><i class="fas fa-user-clock"></i> Attendance Log</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-user-edit"></i> Sales Log Activity</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-chart-line"></i>  Sales Pipeline Report </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fas fa-money-bill-wave"></i> Finance</a>
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
                                    <button type="button" id="sidebarCollapse" class="btn btn-info">
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
                </div>
            </nav>




       