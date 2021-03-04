<div class="container">
    <div class="row" style="padding-bottom: 3vw;">
    <div class="col-md-3">
      <div class="card-counter primary">
        <i class="fas fa-filter"></i>
        <span class="count-numbers"><?php echo $countSales; ?></span>
        <span class="count-name">Sales Progress</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter danger">
        <i class="fas fa-user-tie"></i>
        <span class="count-numbers"><?php echo $countEmployee; ?></span>
        <span class="count-name">Employee</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter success">
        <i class="fas fa-box"></i>
        <span class="count-numbers"><?php echo $countProduct; ?></span>
        <span class="count-name">Product</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter info">
        <i class="fa fa-users"></i>
        <span class="count-numbers"><?php echo $countClient; ?></span>
        <span class="count-name">Client</span>
      </div>
    </div>
    </div>
   
        <div class="row">
            <div class="col-7">
                <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info ">
                    <div id="salespipelineChart" >
                    </div>
                </div>
            </div>

            <div class="col-5">
                <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info ">
                    <div id="deliveryChart" >
                    </div>
                </div>
            </div>        
        </div>
    

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
                    dataLabels: {
                        enabled: true,
                        
                    }
                }
            },
            series: [{
                name: 'Count',
                colorByPoint: true,
                data: [{
                    name: 'Video',
                    y: <?php echo $countVideo; ?>,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Learning',
                    y:<?php echo $countLearning; ?>,
                }, {
                    name: 'Consulting',
                    y: <?php echo $countConsulting; ?>,
                }, {
                    name: 'Digital Content',
                    y:<?php echo $countDigital; ?>
                }]
            }]
        });
                    
            </script>

        <script>
           Highcharts.chart('salespipelineChart', {

            title: {
                text: 'Pipeline Status Growth'
            },


            yAxis: {
                title: {
                    text: 'Pipeline Status Count'
                }
            },


            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 2010
                }
            },

            series: [{
                name: 'Meeting',
                data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
            }, {
                name: 'Proposal',
                data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
            }, {
                name: 'Closing',
                data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
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
  
</div>