<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

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

    <div class="container">
    <h2><i class="fas fa-briefcase"></i> Presensi </h2>
    <hr>

    <form method="POST" action="<?php echo base_url('Attendance/save_clockin'); ?>">
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="text" id="id_attendance" name="id_attendance" value="<?php if(!empty($dataAttendance)) echo $dataAttendance->id_attendance; ?>"> 
            </div>
        </div>

        <div  class="form-group row">
                <label class="col-sm-2 col-form-label">Name </label>
                <div class="col-sm-10">
                    <select name="nik" class="form-select" aria-label="Default select example">
                        
                        <?php foreach($dataEmployee as $row) : ?>
                            <option value="<?php echo $row->nik; ?>"
                            
                            <?php if(!empty($dataAttendance) && session()->get('nik') == $row->nik) echo 'selected'; ?> > 
                            
                            <?php echo $row->name//session()->get('name') ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
                
        </div>
    
        <div  class="form-group row">
            <label class="col-sm-2 col-form-label">Clock In </label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="clock_in" name="clock_in" value="<?php if(!empty($dataAttendance)) echo $dataAttendance->clock_in; ?>"> 
               
            </div>
        </div>

        <div  class="form-group row">
            <label class="col-sm-2 col-form-label">Clock Out </label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="clock_out" name="clock_out" value="<?php if(!empty($dataAttendance)) echo date("Y-m-d h:i:s"); ?>"> 
               
            </div>
        </div>

            <button type="submit" class="btn btn-success" id="checktime">Clock In</button>

        </form>

<br>

        <form method="POST" action="<?php echo base_url('Attendance/save_clockin'); ?>">
        <div  class="form-group row">
            <label  class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="text" id="id_attendance" name="id_attendance" value="<?php if(!empty($dataAttendance)) echo $dataAttendance->id_attendance; ?>"> 
            </div>
        </div>

        <div  class="form-group row">
                <label class="col-sm-2 col-form-label">Name </label>
                <div class="col-sm-10">
                    <select name="nik" class="form-select" aria-label="Default select example">
                        
                        <?php foreach($dataEmployee as $row) : ?>
                            <option value="<?php echo $row->nik; ?>"
                            
                            <?php if(!empty($dataAttendance) && session()->get('nik') == $row->nik) echo 'selected'; ?> > 
                            
                            <?php echo $row->name//session()->get('name') ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
                
        </div>
   
        <div  class="form-group row">
            <label class="col-sm-2 col-form-label">Clock In </label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="clock_in" name="clock_in" value="<?php if(!empty($dataAttendance)) echo $dataAttendance->clock_in; ?>"> 
               
            </div>
        </div>
        
        <div  class="form-group row">
            <label class="col-sm-2 col-form-label">Clock Out </label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="clock_out" name="clock_out" value="<?php if(!empty($dataAttendance)) echo date("Y-m-d h:i:s"); ?>"> 
               
            </div>
        </div>
           
           
            <button type="submit" class="btn btn-success" id="checktime2">Clock Out</button>

        </form>

        
    </div>
</section>
</div><div id="watch"></div>

<script>

    /**
 * Get the current time
 */
function getNow() {
    var now = new Date();

    return {
        hours: now.getHours() + now.getMinutes() / 60,
        minutes: now.getMinutes() * 12 / 60 + now.getSeconds() * 12 / 3600,
        seconds: now.getSeconds() * 12 / 60
    };
}

/**
 * Pad numbers
 */
function pad(number, length) {
    // Create an array of the remaining length + 1 and join it with 0's
    return new Array((length || 2) + 1 - String(number).length).join(0) + number;
}

var now = getNow();

// Create the chart
Highcharts.chart('watch', {

    chart: {
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false,
        height: '80%'
    },

    credits: {
        enabled: false
    },

    title: {
        text: 'The Highcharts clock'
    },

    pane: {
        background: [{
            // default background
        }, {
            // reflex for supported browsers
            backgroundColor: Highcharts.svg ? {
                radialGradient: {
                    cx: 0.5,
                    cy: -0.4,
                    r: 1.9
                },
                stops: [
                    [0.5, 'rgba(255, 255, 255, 0.2)'],
                    [0.5, 'rgba(200, 200, 200, 0.2)']
                ]
            } : null
        }]
    },

    yAxis: {
        labels: {
            distance: -20
        },
        min: 0,
        max: 12,
        lineWidth: 0,
        showFirstLabel: false,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 5,
        minorTickPosition: 'inside',
        minorGridLineWidth: 0,
        minorTickColor: '#666',

        tickInterval: 1,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        title: {
            text: 'Powered by<br/>Highcharts',
            style: {
                color: '#BBB',
                fontWeight: 'normal',
                fontSize: '8px',
                lineHeight: '10px'
            },
            y: 10
        }
    },

    tooltip: {
        formatter: function () {
            return this.series.chart.tooltipText;
        }
    },

    series: [{
        data: [{
            id: 'hour',
            y: now.hours,
            dial: {
                radius: '60%',
                baseWidth: 4,
                baseLength: '95%',
                rearLength: 0
            }
        }, {
            id: 'minute',
            y: now.minutes,
            dial: {
                baseLength: '95%',
                rearLength: 0
            }
        }, {
            id: 'second',
            y: now.seconds,
            dial: {
                radius: '100%',
                baseWidth: 1,
                rearLength: '20%'
            }
        }],
        animation: false,
        dataLabels: {
            enabled: false
        }
    }]
},

// Move
function (chart) {
    setInterval(function () {

        now = getNow();

        if (chart.axes) { // not destroyed
            var hour = chart.get('hour'),
                minute = chart.get('minute'),
                second = chart.get('second'),
                // run animation unless we're wrapping around from 59 to 0
                animation = now.seconds === 0 ?
                    false : {
                        easing: 'easeOutBounce'
                    };

            // Cache the tooltip text
            chart.tooltipText =
                    pad(Math.floor(now.hours), 2) + ':' +
                    pad(Math.floor(now.minutes * 5), 2) + ':' +
                    pad(now.seconds * 5, 2);


            hour.update(now.hours, true, animation);
            minute.update(now.minutes, true, animation);
            second.update(now.seconds, true, animation);
        }

    }, 1000);

});

/**
 * Easing function from https://github.com/danro/easing-js/blob/master/easing.js
 */
Math.easeOutBounce = function (pos) {
    if ((pos) < (1 / 2.75)) {
        return (7.5625 * pos * pos);
    }
    if (pos < (2 / 2.75)) {
        return (7.5625 * (pos -= (1.5 / 2.75)) * pos + 0.75);
    }
    if (pos < (2.5 / 2.75)) {
        return (7.5625 * (pos -= (2.25 / 2.75)) * pos + 0.9375);
    }
    return (7.5625 * (pos -= (2.625 / 2.75)) * pos + 0.984375);
};
              
</script>
