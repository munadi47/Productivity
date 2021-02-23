<div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-chalkboard-teacher"></i> Consulting Form Input </h2>
    <hr>
    <br>
        <form method="POST" action="<?php echo site_url('Consulting/save'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_consulting" name="id_consulting" value="<?php if(!empty($dataConsul)) echo $dataConsul->id_consulting; ?>"> 
            </div>
        </div>
        
        
        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <select name="id_SalesPipeline" class="form-select" aria-label="Default select example" >
                        
                        <?php foreach($dataPipeline as $row) : ?>
                            <option value="<?php echo $row->id_SalesPipeline; ?>"<?php if(!empty($dataConsul) && $dataConsul->id_SalesPipeline == $row->id_SalesPipeline) echo 'selected'; ?> > <?php echo $row->title; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label">Project Name</label>
            <div class="col-sm-10">
            <input type="text" id="project_name" name="project_name" value="<?php if(!empty($dataConsul)) echo $dataConsul->project_name; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label">Project Manager</label>
            <div class="col-sm-10">
            <input type="text" id="project_manager" name="project_manager" value="<?php if(!empty($dataConsul)) echo $dataConsul->project_manager; ?>"> 
            </div>
        </div>
        
        
       
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
            <textarea placeholder="Catatan" id="remark" name="remark" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php if(!empty($dataDigital)) echo $dataDigital->remark; ?></textarea> 
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