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
            <div class="col">
                <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info "  data-aos="zoom-in" data-aos-duration="1000">
                    <div id="deliveryChart" >
                    </div>
                </div>
            </div>        
        </div>
 
       
        <script>
                  const chart = Highcharts.chart('deliveryChart', {
                    title: {
                        text: 'Delivery Count Data'
                    },
                    subtitle: {
                        text: 'Jumlah delivery setiap kategori'
                    },
                    xAxis: {
                        categories: ['Video','Learning','Digital Content','Consulting']
                    },
                    series: [{
                        type: 'column',
                        colorByPoint: true,
                        data: [<?php echo $countVideo;?>,<?php echo $countLearning; ?>,<?php echo $countDigital; ?>,<?php echo $countConsulting; ?>],
                        showInLegend: false
                    }]
                });

                document.getElementById('plain').addEventListener('click', () => {
                    chart.update({
                        chart: {
                            inverted: false,
                            polar: false
                        },
                        subtitle: {
                            text: 'Plain'
                        }
                    });
                });          
        </script>
  
</div>