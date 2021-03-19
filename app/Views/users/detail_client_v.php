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
                <div class="row">
                    <div class="col-8">    
                        <a title="Back" href="<?php echo base_url("Client"); ?>" class="btn btn-outline-info btn-md">
                        <i class="fas fa-arrow-left"></i> 
                        </a>
                        <br>
                        <br>
                    </div>
                </div>
                <h4> CLIENT DETAIL  </h4>
               
                <!--
                    <div class="col-4" >
                    <form method="GET" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Find here.." name="keyword">
                        <div class="input-group-append">
                            <button class="btn btn-info" name="submit" type="submit"> <i class="fa fa-search" ></i> </button>
                        </div>
                    </div>
                    </form>
                    </div>
                </div>  -->
                    
                <?php foreach ($dataClient as $row) :?>
                
                <br>
                <br>
                <div class="row justify-content-start">
                    <div class="col col-lg-2">
                    <i class="fas fa-users"></i> Client 
                    </div>
                    <div class="col col-lg-5">
                        : <?php echo $row->id_client ?>
                    </div>
                </div>
                <br>
                <div class="row justify-content-start">
                    <div class="col col-lg-2">
                    <i class="fas fa-building"></i> Business Type 
                    </div>
                    <div class="col col-lg-5">
                        : <?php echo $row->sector ?>
                    </div>
                </div>
                <br>
                <div class="row justify-content-start">
                    <div class="col col-lg-2">
                    <i class="fas fa-map"></i> Address 
                    </div>
                    <div class="col col-lg-5">
                        : <?php echo $row->address ?>
                        
                    </div>
                </div>
                <br>
                <div class="row justify-content-start">
                    <div class="col col-lg-2">
                    <i class="fas fa-envelope"></i> Email 
                    </div>
                    <div class="col col-lg-5">
                        : <?php echo $row->email_client ?>
                        
                    </div>
                </div>
                <br>
                <div class="row justify-content-start">
                    <div class="col col-lg-2">
                    <i class="fas fa-phone"></i> Phone 
                    </div>
                    <div class="col col-lg-5">
                        : <?php echo $row->phone ?>
                    </div>
                </div>
                <br>
                <div class="row justify-content-start">
                    <div class="col col-lg-2">
                    <i class="fas fa-user-tie"></i> PIC 
                    </div>
                    <div class="col col-lg-5">
                        : <?php echo $row->name ?>
                    </div>
                </div>
                <br>
                
                <?php endforeach; ?>
                <?php foreach ($dataDetail as $row) :?>
                   
             
               
                <!-- Timeline -->
                <ul class="timeline">
                    <li class="timeline-item bg-white rounded ml-3 p-4 shadow " >
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
            <div class="float-right">
                <?php echo $pager->links('dataDetail', 'bootstrap_pagination'); ?>
                </div>
                    
                    <?php
                    if (empty($dataDetail)) {
                    ?>
                        <div class="card">
                            <div class="card-body">
                                No data in pipeline 
                            </div>
                        </div>
    
                    <?php
    
                    }
                    
                    ?>

                    

               


                          
                
               
           
            </div>
            <br>

               
        </div>  
                
               
      

        
    


</section>
</div>