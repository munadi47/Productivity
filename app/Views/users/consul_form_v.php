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
    <i class="fas fa-exclamation"></i> &nbsp;You doesn't input Consulting on pipeline table yet, Please input data first ! &nbsp;  
    <a title="Add pipeline for consulting" href="<?php echo base_url("SalesPipeline/add"); ?>" class="btn btn-info btn-md">
        <i class="fas fa-edit"></i> Input data 
    </a> 
    </div>

<?php } ?>
<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-chalkboard-teacher"></i> Consulting Form Input </h2>
    <hr>
    <br>
        <form enctype="multipart/form-data" method="POST" action="<?php echo base_url('Consulting/save'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_consulting" name="id_consulting" value="<?php if(!empty($dataConsul)) echo $dataConsul->id_consulting; ?>"> 
            </div>
        </div>
        
        
        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
               
                    <select required name="id_SalesPipeline" class="form-select" aria-label="Default select example" >
                        
                        <?php foreach($dataPipeline as $row) : ?>
                            <option value="<?php echo $row->id_SalesPipeline; ?>"<?php if(!empty($dataConsul) && $dataConsul->id_SalesPipeline == $row->id_SalesPipeline) echo 'selected'; ?> > <?php echo $row->title; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
              
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label">Project Name</label>
            <div class="col-sm-10">
            <input required type="text" class="form-control" id="project_name" name="project_name" value="<?php if(!empty($dataConsul)) echo $dataConsul->project_name; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label">Project Manager</label>
            <div class="col-sm-10">
            <input required type="text"class="form-control" id="project_manager" name="project_manager" value="<?php if(!empty($dataConsul)) echo $dataConsul->project_manager; ?>"> 
            </div>
        </div>
        
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label">Gantt chart Attachment </label>
            <div class="col-sm-10">
            <input  class="form-control" type="file" id="gantt_chart" name="gantt_chart" value="<?php if(!empty($dataConsul)) echo base_url('assets/uploads/chart/'.$dataConsul->gantt_chart); ?>">
            <label class="form-label" for="customFile" style="color: red; font-size: 12px;"> * Upload Data (Max: 5MB, Format: PDF, JPG, PNG)</label>
            </div>
        </div>
  
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
            <textarea placeholder="Catatan" id="remark" name="remark" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php if(!empty($dataConsul)) echo htmlspecialchars($dataConsul->remark) ; ?></textarea> 
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