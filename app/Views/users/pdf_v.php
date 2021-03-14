
    <?php
if(!empty(session()->getFlashdata('Success'))){ ?>
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
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-chalkboard-teacher"></i> Consulting</li>
    </ol>
    </nav>
   
    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
    <section>  
                <div class="row">
                    <div class="col">
                    <a title="Back" href="<?php echo base_url("Consulting"); ?>" class="btn btn-outline-info btn-md">
                    <i class="fas fa-arrow-left"></i> 
                    </a>
                    </div>
                    <div class="col-9">
                  
                    </div>
                    <div class="col">
                   
                    </div>
                </div>
               

               
                <br>    
                <br>
                <h1><strong> <?php echo $dataConsul->project_name; ?></strong><br></h1>
                <?php if(empty($dataConsul->gantt_chart)){ ?>
                    <div class="alert alert-warning" role="alert">
                    <i class="fa fa-exclamation"> </i> &nbsp; Please Upload File First &nbsp; <a title="Upload on edit menu"  href="<?php echo base_url("Consulting/edit/".$dataConsul->id_consulting); ?>" alt="Upload" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-edit"> </i>  Upload Gantt Chart
                            </a>
                    </div>
                <?php }?>
               
                    
                    
              
                <embed src="<?php echo base_url('assets/uploads/chart/'.$dataConsul->gantt_chart); ?>" type="application/pdf" width="100%" height="1000px"></embed>
               
       
        
   


    </section>
    </div>
