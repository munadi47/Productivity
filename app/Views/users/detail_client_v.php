<nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-filter"></i> Sales Pipeline</a></li>
        <li class="breadcrumb-item" aria-current="page"><i class="fas fa-users"></i> Client</li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-search"></i> Client Detail</li>
    </ol>
</nav>

<div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000" >
<section>  
                <div class="card-body">
                <h4> CLIENT DETAIL  </h4>
               
                <a title="Back" href="<?php echo base_url("Client"); ?>" class="btn btn-outline-info btn-md">
                <i class="fas fa-arrow-left"></i> 
                </a>
            
               
                
                <br>
                <br>
                <span class="table-responsive">
                <table id="myTable" class="table table-hover table-bordered text-center " >
                <thead class="thead-dark ">
                    <tr>
                        <th> # </th>
                        <th>CLIENT NAME</th>
                        <th>TITLE PRODUCT</th>
                        <th>CATEGORY</th>
                        <th>COUNT</th>
                        <th>POTENTIAL REVENUE</th>
                        <th>TOTAL REVENUE</th>
                        <th>STATUS</th>
                       
                    
                    </tr>
                </thead>
                <tbody>
                

                <?php
               
                ?>
                <?php $nomor = 1; ?>
                <?php foreach ($dataClient as $row) :?>
                    
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->client_name; ?></td>
                        <td><?php echo $row->title; ?></td>
                        <td><?php echo $row->category; ?></td>
                        <td><?php echo $row->count; ?></td>
                        <td><?php echo $row->potential_revenue; ?></td>
                        <td><?php echo $row->total_revenue; ?></td>
                        <td><?php echo $row->status ;?></td>
                       
                    </tr>
                    
                <?php 

                endforeach;
                ?>
                <?php
                if (empty($dataClient)) {
                ?>

                    <tr>
                        <td class="text-center" colspan="9">No Data</td>
                    </tr>

                <?php

                }
                
                ?>
                </tbody>
            </table>
                </span>
            </div>
            <br>

               
                
                
               
      

        
    


</section>
</div>