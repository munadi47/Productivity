<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
    <link rel="shortcut icon" type="image/jpg" href="<?php echo base_url('assets/img/favicon.ico'); ?>"/>
    <!--AOS-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <!--CUSTOM CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style_login.css'); ?>">
    <!------ Include the above in your HEAD tag ---------->
    
    <body>
        <div id="login">
            
                <img   src="<?php echo base_url('assets/img/LOGO IDE.png'); ?>" width="114" height="77" class="tengah" alt="">
                
              
            <div class="container">
                <div data-aos="fade-up"
                data-aos-offset="200"
                data-aos-delay="50"
                data-aos-duration="1000"
                data-aos-easing="ease-in-out"
                data-aos-mirror="true"
                data-aos-once="false"
                data-aos-anchor-placement="top-center"
                id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center text-info"><i class="fas fa-sign-in-alt"></i> Login</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info"><i class="fas fa-envelope"></i> Email:</label><br>
                                    <input type="text" name="username" id="username" class="form-control" alt="username"  placeholder="user@ide.learning.co.id" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info"><i class="fas fa-key"></i> Password:</label><br>
                                    <input type="text" name="password" id="password" class="form-control" alt="password"  placeholder="********" required>
                                </div>
                                <div class="form-group">
                                   
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
          AOS.init();
        </script>
    </body>
    
    
</html>