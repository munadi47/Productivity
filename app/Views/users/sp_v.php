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

    <nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000">
    <ol class="breadcrumb">
    
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-filter"></i> Sales Pipeline</a></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-chart-line"></i> Pipeline</li>
    </ol>
    </nav>

    <!-- GRAFIK -->
    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
        <div id="myChart">
            <script> 
                    Highcharts.chart('myChart', {
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
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                <h4> SALES PIPELINE  </h4>
                <br>
                <a title="Add data"  href="<?php echo base_url("SalesPipeline/add/"); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-plus"></i> 
                </a>
                
                <a title="Export data to excel" href="<?php echo base_url("SalesPipeline/export/"); ?>" class="btn btn-outline-info btn-sm">
                <i class="fas fa-file-excel"></i> 
                </a>
               
                <br>
                <br>
                <span class="table-responsive">
                <table id="myTable" class="table table-hover table-bordered text-center " >
                <thead class="thead-dark ">
                <!--$data = [
    
    'nik'=>$this->request->getPost('nik'),
    'id_client'=>$this->request->getPost('id_client'),
    'id_product'=>$this->request->getPost('id_product'),
    'category'=>$this->request->getPost('category'),
    'title'=>$this->request->getPost('title'),
    'count'=>$this->request->getPost('count'),
    'potential_revenue'=>$this->request->getPost('potential_revenue'),
    'total_revenue'=>$this->request->getPost('total_revenue'),
    'status'=>$this->request->getPost('status'), 
];-->
                    <tr>
                        <th> # </th>
                        <th>PIC</th>
                        <th>CLIENT</th>
                        <th>PRODUCT</th>
                        <th>CATEGORY</th>
                        <th>TITLE</th>
                        <th>COUNT</th>
                        <th>POTENTIAL REVENUE</th>
                        <th>TOTAL REVENUE</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    
                    </tr>
                </thead>
                <tbody>
                

                <?php
               
                ?>
                <?php $nomor = 1; ?>
                <?php foreach ($dataPipeline as $row) :?>
                    
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->id_client; ?></td>
                        <td><?php echo $row->product_name; ?></td>
                        <td><?php if($row->category=='video'){
                            ?> <span class="badge badge-primary"><i class="fas fa-video">&nbsp;</i><?php
                           
                                }  elseif($row->category=='digital content'){
                                    ?><span class="badge badge-primary"><i class="fas fa-desktop"></i><?php

                                } elseif($row->category=='learning'){
                                    ?><span class="badge badge-primary"><i class="fas fa-graduation-cap">&nbsp;</i><?php
                                }else{
                                    ?><span class="badge badge-primary"><i class="fas fa-chalkboard-teacher">&nbsp;</i><?php
                                }
                                echo '&nbsp;'.$row->category; ?>
                        </td>
                        <td><?php echo $row->title; ?></td>
                        <td><?php echo $row->count; ?></td>
                        <td>Rp. <?php echo $row->potential_revenue=number_format($row->potential_revenue,0,",","."); ?></td>
                        <td>Rp. <?php echo $row->total_revenue=number_format($row->total_revenue,0,",","."); ?></td>
                        <td><?php if($row->status=='closing'){
                            ?> <span class="badge badge-danger"><?php
                           
                                } elseif($row->status=='proposal'){
                                    ?><span class="badge badge-warning"><?php

                                } else{
                                    ?><span class="badge badge-success"><?php
                                }
                                echo $row->status; ?>
                        </td>
                        <td>
                            <a title="Edit"  href="<?php echo base_url("SalesPipeline/edit/".$row->id_SalesPipeline); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-edit"></i> 
                            </a>
                            <a title="Delete" href="<?php echo base_url("SalesPipeline/delete/".$row->id_SalesPipeline); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                            <i class="fa fa-trash" ></i> 
                            </a>
                        </td>
                    </tr>
                    
                <?php 

                endforeach;
                ?>
                <?php
                if (empty($dataPipeline)) {
                ?>

                    <tr>
                        <td class="text-center" colspan="11">No Data</td>
                    </tr>

                <?php

                }
                
                ?>
                </tbody>
            </table>
                </span>
            </div>
        
    


</section>
