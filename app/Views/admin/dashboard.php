<div class="container">
    <div class="row" style="padding-bottom: 3vw;">
    <div class="col-md-3">
      <div class="card-counter primary">
        <i class="fas fa-filter"></i>
        <span class="count-numbers">12</span>
        <span class="count-name">Sales Progress</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter danger">
        <i class="fas fa-user-tie"></i>
        <span class="count-numbers">599</span>
        <span class="count-name">Employee</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter success">
        <i class="fas fa-box"></i>
        <span class="count-numbers">6875</span>
        <span class="count-name">Product</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter info">
        <i class="fa fa-users"></i>
        <span class="count-numbers">35</span>
        <span class="count-name">Client</span>
      </div>
    </div>
    </div>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded">
        <div class="row">
            <div id="myChart">
            </div>
        </div>
    </div>

    <script>
 Highcharts.chart('myChart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Delivery data count'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Video',
            y: 61.41,
            sliced: true,
            selected: true
        }, {
            name: 'Learning',
            y: 11.84
        }, {
            name: 'Consulting',
            y: 10.85
        }, {
            name: 'Digital Content',
            y: 4.67
        }]
    }]
});
              
    </script>
  
</div>