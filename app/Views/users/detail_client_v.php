<nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000">
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

                <?php foreach ($dataClient as $row) :?>
               
                <!-- Timeline -->
                <ul class="timeline">
                    <li class="timeline-item bg-white rounded ml-3 p-4 shadow  ">
                        <div class="timeline-arrow"></div>
                        <h2 class="h5 mb-0"><?php echo $row->title; ?></h2><br>
                        <pre>
        Category     :&nbsp;   <?php echo $row->category; ?> <br>
        Count        :&nbsp;   <?php echo $row->count; ?> <br>
        Total Price  :&nbsp;   Rp. <?php echo $row->potential_revenue=number_format($row->potential_revenue,0,",","."); ?> <br>
        Status       :&nbsp;  <?php if($row->status=='closing'){
                                ?> <span class="badge badge-danger"><?php
                           
                                }  elseif($row->status=='proposal'){
                                    ?><span class="badge badge-warning"><?php

                                } else{
                                    ?><span class="badge badge-success"><?php
                                }
                                echo $row->status; ?>
                        </pre>
                        
                    </li>
                  
                </ul><!-- End -->

            <?php endforeach; ?>
                    
                    <?php
                    if (empty($dataClient)) {
                    ?>
                        <div class="card">
                            <div class="card-body">
                                No data
                            </div>
                        </div>
    
                    <?php
    
                    }
                    
                    ?>

                    

               


                          
                
                <!--<div style="float: right">
                <?php/* echo $pager->links('dataClient', 'bootstrap_pagination'); */?>
                </div>-->
           
            </div>
            <br>

               
                
                
               
      

        
    


</section>
</div>