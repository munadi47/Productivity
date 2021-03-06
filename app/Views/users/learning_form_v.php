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
    <i class="fas fa-exclamation"></i> &nbsp;You doesn't input Learning on pipeline table yet, Please input data first ! &nbsp;  
    <a title="Add pipeline for learning" href="<?php echo base_url("SalesPipeline/add"); ?>" class="btn btn-info btn-md">
        <i class="fas fa-edit"></i> Input data 
    </a> 
    </div>

<?php } ?>
<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-graduation-cap"></i> Learning Form Input </h2>
    <hr>
    <br>
        <form method="POST" action="<?php echo site_url('Learning/save'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_learning" name="id_learning" value="<?php if(!empty($dataLearning)) echo $dataLearning->id_learning; ?>"> 
            </div>
        </div>
        
        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Project Title</label>
                <div class="col-sm-10">
                    <select required name="id_SalesPipeline" class="form-select" aria-label="Default select example" data-live-search="true" >
                        <?php foreach($dataPipeline as $row) : ?>
                            <option value="<?php echo $row->id_SalesPipeline; ?>"<?php if(!empty($dataLearning) && $dataLearning->id_SalesPipeline == $row->id_SalesPipeline) echo 'selected'; ?> > <?php echo $row->title; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Topic</label>
            <div class="col-sm-10">
            <input type="text" id="topic" name="topic" class="form-control" id="exampleFormControlTextarea1" value="<?php if(!empty($dataLearning)) echo $dataLearning->topic; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Date Of Deliver</label>
            <div class="col-sm-10">
            <input type="date" id="date_deliver" name="date_deliver" class="form-control" id="exampleFormControlTextarea1" value="<?php if(!empty($dataLearning)) echo $dataLearning->date_deliver; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Coach Name</label>
            <div class="col-sm-10">
            <input type="text" id="coach_name" name="coach_name" class="form-control" id="exampleFormControlTextarea1" value="<?php if(!empty($dataLearning)) echo $dataLearning->coach_name; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Method</label>
            <div class="col-sm-10">
            <select name="method" id="method" class="form-select" aria-label="Default select example">
                            <option selected><?php if(!empty($dataLearning)) echo $dataLearning->method; ?> </option>
                            <option value="online"><span class="badge badge-success"> Online </span></option>
                            <option value="offline"><span class="badge badge-warning"> Offline </span></option>
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Certificate</label>
            <div class="col-sm-10">
            <select name="certificate" id="certificate" class="form-select" aria-label="Default select example">
                            <option selected><?php if(!empty($dataLearning)) echo $dataLearning->certificate; ?> </option>
                            <option value="yes"><span class="badge badge-success"> Yes </span></option>
                            <option value="no"><span class="badge badge-warning"> No </span></option>
            </select>
            </div>
        </div>
 
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
            <textarea placeholder="Catatan" id="remark" name="remark" class="form-control" id="exampleFormControlTextarea1"  rows="3"><?php if(!empty($dataLearning)) echo $dataLearning->remark; ?></textarea> 
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
