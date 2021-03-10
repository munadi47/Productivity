<section>
    <?php if(!empty(session()->getFlashdata('Success'))){ ?>
                <div class="alert alert-success">
                    <?php echo session()->getFlashdata('Success');?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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

        <nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><i class="fas fa-table"></i> Company Data</li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Employee</li>
        </ol>
        </nav>


    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >

        <div class="card-body">
        <h4> Employee  </h4>
        <a title="Back" href="<?php echo base_url("Employee"); ?>" class="btn btn-outline-info btn-md">
        <i class="fas fa-arrow-left"></i> 
        </a>
        
        <br>
        <?php foreach ($dataEmployee as $row) :?>

            
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="<?php if(!empty($row->photo)){ 
                                echo base_url('assets/uploads/profile/'.session()->get('photo'));
                            }
                            else
                            { 
                                echo base_url('http://placehold.it/250x250'); 
                                }?>" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        <?php echo $row->name; ?>
                                    </h5>
                                    <h6>
                                        
                                    </h6>
                                    <p class="proile-rating">NIK :<?php echo $row->nik; ?></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Performance</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <!--div class="profile-work">
                            <p>SKILLS</p>
                            <a href="">Web Designer</a><br/>
                            <a href="">Web Developer</a><br/>
                            <a href="">WordPress</a><br/>
                            <a href="">WooCommerce</a><br/>
                            <a href="">PHP, .Net</a><br/>
                        </div-->
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Birthday</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $row->birthday; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $row->email; ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone 1</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><a class="btn btn-primary" href="tel:<?php echo $row->phone1; ?>"><i class="fas fa-phone" style="padding-right: 1px;"></i>  <?php echo $row->phone1; ?></a></p>
                                            </div>
                                        </div>
                                        <?php if(!empty($row->phone2)) {?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone 2</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><a class="btn btn-primary" href="tel:<?php echo $row->phone2; ?>"><i class="fas fa-phone" style="padding-right: 1px;"></i>  <?php echo $row->phone2; ?></a></p>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $row->address; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Status</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                    <?php if($row->status=='aman'){
                                                        ?><span class="badge badge-success"><?php
                                                    
                                                    } elseif($row->status=='peringatan1'){
                                                        ?><span class="badge badge-danger"><?php
                                                    }else{
                                                        ?><span class="badge badge-warning"><?php
                                                    } echo $row->status; ?><br>
                                                </p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Closing count</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $countClosing; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Present count for this week </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>20</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>PIC client count</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $countPICClient ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                               
                                            </div>
                                            
                                        </div>
                                        
                            </div>
                        </div>
                    </div>
                </div>
           

            <?php 
            endforeach;
            ?>
            <?php
            if (empty($dataEmployee)) {
            ?>
                <tr>
                    <td class="text-center" colspan="9">No Data</td>
                </tr>

            <?php

            }
            
            ?>
        </div>
        
    </div>


</section>
