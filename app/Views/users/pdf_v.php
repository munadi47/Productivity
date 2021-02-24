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
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-chalkboard-teacher"></i> Consulting</li>
    </ol>
    </nav>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                <h4> <?php $dataConsul->gantt_chart; ?>  </h4>
                <embed src="assets/uploads/<?php echo $dataConsul->gantt_chart; ?>" type='application/pdf' width='100%' height='700px'/>
                
               
                </div>
        
    


</section>
