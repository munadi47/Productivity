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

<?php if(empty($dataPipeline)){ ?>
    <div class="alert alert-warning" role="alert" data-aos="zoom-in" data-aos-duration="1000" >
    <i class="fas fa-exclamation"></i> &nbsp;You doesn't input Video on pipeline table yet, Please input data first ! &nbsp;  
    <a title="Add pipeline for video" href="<?php echo base_url("SalesPipeline/add"); ?>" class="btn btn-info btn-md">
        <i class="fas fa-edit"></i> Input data 
    </a> 
    </div>

<?php } ?>
<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-video"></i> Video Form Input </h2>
    <hr>
    <br>
        <form method="POST" action="<?php echo site_url('Video/save'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_video" name="id_video" value="<?php if(!empty($dataVideo)) echo $dataVideo->id_video; ?>"> 
            </div>
        </div>
        
        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Project Title</label>
                <div class="col-sm-10">
                    <select required name="id_SalesPipeline" class="form-select" aria-label="Default select example" >
                        
                        <?php foreach($dataPipeline as $row) : ?>
                            <option value="<?php echo $row->id_SalesPipeline; ?>"<?php if(!empty($dataVideo) && $dataVideo->id_SalesPipeline == $row->id_SalesPipeline) echo 'selected'; ?> > <?php echo $row->title; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Storyboard</label>
            <div class="col-sm-4">
            <input class="form-control" type="text" placeholder="PIC" id="storyboard_pic" name="storyboard_pic" value="<?php if(!empty($dataVideo)) echo $dataVideo->storyboard_pic; ?>"> 
            </div>
            <label class="col-sm-2 col-form-label">Due Date</label>
            <div class="col-sm-4">
            <input  class="form-control"  type="date" id="storyboard_date" name="storyboard_date" value="<?php if(!empty($dataVideo)) echo $dataVideo->storyboard_date; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Shooting</label>
            <div class="col-sm-4">
            <input  class="form-control" type="text" placeholder="PIC" id="shooting_pic" name="shooting_pic" value="<?php if(!empty($dataVideo)) echo $dataVideo->shooting_pic; ?>"> 
            </div>
            <label class="col-sm-2 col-form-label">Due Date</label>
            <div class="col-sm-4">
            <input  class="form-control" type="date" id="shooting_date" name="shooting_date" value="<?php if(!empty($dataVideo)) echo $dataVideo->shooting_date; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Editing</label>
            <div class="col-sm-4">
            <input  class="form-control" type="text" placeholder="PIC" id="editing_pic" name="editing_pic" value="<?php if(!empty($dataVideo)) echo $dataVideo->editing_pic; ?>"> 
            </div>
            <label class="col-sm-2 col-form-label">Due Date</label>
            <div class="col-sm-4">
            <input class="form-control" type="date" id="editing_date" name="editing_date" value="<?php if(!empty($dataVideo)) echo $dataVideo->editing_date; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
            <textarea placeholder="Catatan" id="remark" name="remark" class="form-control" id="exampleFormControlTextarea1" value="" rows="3"><?php if(!empty($dataVideo)) echo $dataVideo->remark; ?></textarea> 
            </div>
        </div>

        <br>
        <br>
        <br>
      
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" onclick="window.history.back();" class="btn btn-outline-secondary">Back</button>
            <br>
        </form>
    </div>
</section>
</div>
