<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- Refresh setiap 1 menit -->
<!--meta http-equiv="refresh" content="60"-->

<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
<section>

<?php if(!empty(session()->getFlashdata('Success'))){ ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('Success');?>
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }elseif(!empty(session()->getFlashdata('Failed'))){ ?>
                    <div class="alert alert-danger">
                        <?php 
                            echo session()->getFlashdata('Failed');
                        ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    <?php
    }
    ?>

    <h2><i class="fas fa-briefcase"></i> Presensi </h2>

    <figure class="highcharts-figure">
    <div id="watch"></div>
    <p class="highcharts-description">
        
    </p>
    </figure>
    <div class="container">

<br/>

        <div class='text-center'>
        <a title="Delete" href="<?php echo base_url("Attendance/clockin"); ?>" class="btn btn-sq-lg btn-primary">
        <i class="fa fa-sign-in-alt fa-5x"></i><br> Clock In 
        </a>

        <a title="Delete" href="<?php echo base_url("Attendance/clockout/".getInsertID()); ?>" class="btn btn-sq-lg btn-danger">
        <i class="fa fa-sign-out-alt fa-5x" aria-hidden="true"></i><br> Clock Out 
        </a>

    </div>
</section>
</div>
