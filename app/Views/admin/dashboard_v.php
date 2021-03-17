

<?php if(!empty($deadlineShoot)){ ?>
    <div class="alert alert-warning" role="alert"  data-aos="zoom-in" data-aos-duration="1000">
    <?php foreach($deadlineShoot as $row): echo '<i class="fas fa-bell"></i> '; echo $row->shooting_date; echo ' '.$row->shooting_pic; endforeach; ?>
        The shooting is due today, please check the video schedule
    </div>
<?php }?>

<?php if(!empty($deadlineEdit)){ ?>
    <div class="alert alert-warning" role="alert"  data-aos="zoom-in" data-aos-duration="1000">
    <?php foreach($deadlineEdit as $row): echo '<i class="fas fa-bell"></i> '; echo $row->editing_date; echo ' '.$row->editing_pic; endforeach; ?>
        The editing is due today, please check the video schedule
    </div>
<?php }?>


<?php if(!empty($deadlineStoryDigital)){ ?>
    <div class="alert alert-warning" role="alert"  data-aos="zoom-in" data-aos-duration="1000">
    <?php foreach($deadlineStoryDigital as $row): echo '<i class="fas fa-bell"></i> '; echo $row->storyboard_date; echo ' '.$row->storyboard_pic; endforeach; ?>
        The storyboard is due today, please check the digital content schedule
    </div>
<?php }?>

<?php if(!empty($deadlineVoice)){ ?>
    <div class="alert alert-warning" role="alert"  data-aos="zoom-in" data-aos-duration="1000">
    <?php foreach($deadlineVoice as $row):  echo '<i class="fas fa-bell"></i> '; echo $row->voiceover_date; echo ' '.$row->voiceover_pic; endforeach; ?>
        The voiceover is due today, please check the digital content schedule
    </div>
<?php }?>


<?php if(!empty($deadlineAnimate)){ ?>
    <div class="alert alert-warning" role="alert"  data-aos="zoom-in" data-aos-duration="1000">
    <?php foreach($deadlineAnimate as $row):  echo '<i class="fas fa-bell"></i> '; echo $row->animate_date; echo ' '.$row->animate_pic; endforeach; ?>
        The animate is due today, please check the digital content schedule
    </div>
<?php }?>

<?php if(!empty($deadlineCompile)){ ?>
    <div class="alert alert-warning" role="alert"  data-aos="zoom-in" data-aos-duration="1000">
    <?php foreach($deadlineCompile as $row):  echo '<i class="fas fa-bell"></i> ';  echo $row->compile_date; echo ' '.$row->compile_pic; endforeach; ?>
        The animate is due today, please check the digital content schedule
    </div>
<?php }?>

<?php if(!empty($deadlineFinance)){ ?>
    <div class="alert alert-warning" role="alert"  data-aos="zoom-in" data-aos-duration="1000">
    <?php foreach($deadlineFinance as $row):  ?>
        <?php if ($row->id_fStatus == '5') {
            echo '<i class="fas fa-bell"></i> '; echo ' The Invoice payment status for '.$row->id_client; echo ' is Done';?>
        <?php } else { ?>
        <?php echo '<i class="fas fa-bell"></i> '; echo ' The Invoice payment due is today ('.date("d M, Y", strtotime($row->invoice_duedate)).')'; echo ' for'; echo ' '.$row->id_client;  } ?>
    <?php endforeach; ?>
        
    </div>
<?php }?>

<nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000">
    <ol class="breadcrumb">
    
        <li class="breadcrumb-item active"><a href="<?php echo base_url('Dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        
    </ol>
</nav>

<div class="container">

    <div class="row" style="padding-bottom: 3vw;" >
    <div class="col-md-3">
      <div class="card-counter primary"  data-aos="zoom-in" data-aos-duration="1000">
        <i class="fas fa-filter"></i>
        <span class="counter count-numbers"><?php echo $countSales; ?></span>
        <span class="count-name">Sales Progress</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter danger"  data-aos="zoom-in" data-aos-duration="1000">
        <i class="fas fa-user-tie"></i>
        <span class="count-numbers"><?php echo $countEmployee; ?></span>
        <span class="count-name">Employee</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter success"  data-aos="zoom-in" data-aos-duration="1000">
        <i class="fas fa-box"></i>
        <span class="count-numbers"><?php echo $countProduct; ?></span>
        <span class="count-name">Product</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter info"  data-aos="zoom-in" data-aos-duration="1000">
        <i class="fa fa-users"></i>
        <span class="count-numbers"><?php echo $countClient; ?></span>
        <span class="count-name">Client</span>
      </div>
    </div>
    </div>

    <div class="row">
        <div class="col col-lg-7">
          <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info "  data-aos="zoom-in" data-aos-duration="1000">
            <div id="financeChart">
            </div>
          </div>
        </div>

        
        <div class="col col-lg-5">
          <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info "  data-aos="zoom-in" data-aos-duration="1000">
            <div id="deliveryChart">
            </div>
          </div>
        </div>

      </div>

      <div class="row">
      <div class="col col-lg-12">
          <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info " data-aos="zoom-in" data-aos-duration="1000">
            <div id="attendanceChart">
            </div>
          </div>
        </div>

        <div class="col col-lg-7">
            <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
                <div id="sp_chart"> 
                
                </div>
            </div>
        </div>
      
     
        <div class="col col-lg-5">
            <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000">
            <h4> Employee Attendance Today </h4>
            <?php 
                
                if (!empty($AttToday)){ 
            ?>
            <br/>
            <?php foreach($AttToday as $row) : {?>
                
            <div class="list list-row block">
                    <div class="list-item" data-id="19">
                        <div><a href="#" data-abc="true"><span class="<?php  if(empty($row->photo)) { echo base_url( 'https://ssl.gstatic.com/accounts/ui/avatar_2x.png'); } ?>"><img class="img-emp" src="<?php if(empty($row->photo)) { echo base_url( 'https://ssl.gstatic.com/accounts/ui/avatar_2x.png'); } else{ echo base_url('assets/uploads/profile/'.$row->photo);} ?>"></span></a></div>
                        <div class="flex"> <a href="#" class="item-author text-color" data-abc="true"><?php echo $row->name; ?></a>
                            <div class="item-except text-muted text-sm h-1x">Has been absent</div>
                        </div>
                        <div class="no-wrap">
                            <div class="item-date text-muted text-sm d-none d-md-block"><?php echo $row->clock_in; ?></div>
                        </div>
                    </div>
                    
            </div>
            <?php }endforeach; ?>
            <?php } ?>
           
            <div style="float: right;">
                <?php  echo $pager->links('AttToday', 'bootstrap_pagination'); ?>
            </div>
         
            </div>
        </div>
      </div>
    

    

    
</div>
    <script>
        Highcharts.chart('attendanceChart', {

        title: {
            text: 'Attendance Monitoring Graphic per Month'
        },

        subtitle: {
            text: 'Source: ide-group.com'
        },

        yAxis: {
            title: {
                text: 'Number of Attendance'
            }
        },

        xAxis: {
            categories: ['Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
            //categories: [<?php if(!empty($countAttendance)) foreach ($countAttendance as $data) :?> <?php echo  date($data->bulan).", "?>  <?php endforeach;?>]

        },


        series: [{
            name: 'Count',
            data: [<?php if(!empty($countAttendance)) foreach ($countAttendance as $data) echo $data->total.", "?>]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

        });
        </script>
       
        <script>
              Highcharts.chart('financeChart', {
              chart: {
                  type: 'column'
              },
              title: {
                  text: 'Finance Total Income per Year'
              },
              
              xAxis: {
                  categories: [<?php if(!empty($countFinance)) foreach ($countFinance as $data) echo $data->tahun.", "?>]
              },
              yAxis: {
                  title: {
                      text: 'Income'
                  }
              },
              plotOptions: {
                  line: {
                      dataLabels: {
                          enabled: true
                      },
                      enableMouseTracking: false
                  }
              },
              series: [{
                  name: 'Amount',
                  data: [<?php if(!empty($countFinance)) foreach ($countFinance as $data) echo $data->jumlah.", "?>]
              }]
          });
                          
       
        </script>

        <script>
          Highcharts.chart('deliveryChart', {
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: 'Delivery data count'
              },
             
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      
                  }
              },
              series: [{
                  name: 'Delivery',
                  colorByPoint: true,
                  data: [{
                      name: 'Video',
                      y: <?php echo $countVideo;?>,
                      sliced: true,
                      selected: true
                  }, {
                      name: 'Digital Content',
                      y: <?php echo $countDigital; ?>
                  }, {
                      name: 'Learning',
                      y: <?php echo $countLearning; ?>
                  }, {
                      name: 'Consulting',
                      y: <?php echo $countConsulting; ?>
                  }]
              }]
          });
        </script>

        <script> 
                    Highcharts.chart('sp_chart', {
                        chart: {
                            type: 'funnel'
                        },
                        title: {
                            text: 'Sales funnel'
                        },
                        plotOptions: {
                            series: {
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b> ({point.y:,.0f})',
                                    softConnector: true
                                },
                                center: ['50%', '50%'],
                                neckWidth: '20%',
                                neckHeight: '40%',
                                width: '50%'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        series: [{
                            name: 'Client',
                            data: [
                                ['Meeting', <?php echo $countMeeting; ?> ],
                                ['Proposal', <?php echo $countProposal; ?>],
                                ['Closing',  <?php echo $countClosing; ?>]
                            ]
                        }],

                        responsive: {
                            rules: [{
                                condition: {
                                    maxWidth: 300
                                },
                                chartOptions: {
                                    plotOptions: {
                                        series: {
                                            dataLabels: {
                                                inside: true
                                            },
                                            center: ['50%', '50%'],
                                            width: '100%'
                                        }
                                    }
                                }
                            }]
                        }
                    });
          
            </script>


   
  
</div>