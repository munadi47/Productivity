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
    
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-truck-loading"></i> Delivery</a></li>
        <li class="breadcrumb-item " aria-current="page"><i class="fas fa-chalkboard-teacher"></i> Consulting</li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-chart-bar"></i> Gantt Chart</li>
    </ol>
    </nav>
     <!-- GRAFIK -->
     <div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000" >
        <div id="myChart"></div>
            <script>
            // THE CHART
            Highcharts.ganttChart('myChart', {
                title: {<?php $counter=1; ?>
                    text: '<?php foreach ($dataChart as $row) : ?>
                        <?php if ($counter == 2) 
                                break; ?>
                        <?php echo $row->project_name;
                        $counter++;?>
                        <?php endforeach; ?>'
                },
                xAxis: {
                    min: Date.UTC(2021, 2, 1),
                    max: Date.UTC(2021, 12, 30)
                },

                series: [{
                    name: 'Project 1',
                    data: [{
                        name: '<?php ?>',
                        start: ,
                        end: Date.UTC(2014, 10, 25),
                        completed: 0.25
                    }]
                }]
            });




            </script>
           
        
    </div>



    <div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                <h4> GANTT CHART TABLE  </h4>
              
                <a title="Add data"  href="<?php echo base_url("Consulting/add_chart/"); ?>" alt="Add" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-plus"></i> Add Activity
                </a>
              
                <br>
                <br>
                <span class="table-responsive">
                <table id="myTable" class="table table-hover table-bordered text-center " >
                <thead class="thead-dark ">
                    <tr>
                        <th > # </th>
                        <th >ACTIVITY</th>
                        <th >START</th>
                        <th >END</th>
                       
                        <th >ACTION</th>
                    
                    </tr>
                   
                </thead>
                <tbody>
                

                   
                <?php $nomor = 1; ?>
                <?php foreach ($dataChart as $row) :?>
                    
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->start; ?></td>
                        <td><?php echo $row->end; ?></td>

                        <td>
                          
                            <a title="Edit"  href="<?php echo base_url("Consulting/edit_chart/".$row->id_chart); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-edit"></i> 
                            </a>
                            <a title="Delete" href="<?php echo base_url("Consulting/delete_chart/".$row->id_chart); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                            <i class="fa fa-trash" ></i> 
                            </a>
                        </td>
                    </tr>
                    
                <?php 

                endforeach;
                ?>
                <?php
                if (empty($dataChart)) {
                ?>

                    <tr>
                        <td class="text-center" colspan="6">No Data</td>
                    </tr>

                <?php

                }
                
                ?>
                </tbody>
            </table>
                </span>
            </div>
        
    


</section>










