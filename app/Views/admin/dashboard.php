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
        <div class="col col-lg-8">
          <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info "  data-aos="zoom-in" data-aos-duration="1000">
            <div id="financeChart">
            </div>
          </div>
        </div>
        
        <div class="col col-lg-4">
          <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info "  data-aos="zoom-in" data-aos-duration="1000">
            <div id="deliveryChart">
            </div>
          </div>
        
        </div>
      </div>
     
  
        
    
       
        <script>
              Highcharts.chart('financeChart', {
              chart: {
                  type: 'line'
              },
              title: {
                  text: 'Finance Amount Data per Year'
              },
              
              xAxis: {
                  categories: [<?php  foreach ($countFinance as $data) echo $data->tahun.", "?>]
              },
              yAxis: {
                  title: {
                      text: 'Amount'
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
                  data: [<?php foreach ($countFinance as $data) echo $data->jumlah.", "?>]
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
   
  
</div>