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
                <label class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <select required name="id_SalesPipeline" class="form-select" aria-label="Default select example" >
                        
                        <?php foreach($dataPipeline as $row) : ?>
                            <option value="<?php echo $row->id_SalesPipeline; ?>"<?php if(!empty($dataVideo) && $dataVideo->id_SalesPipeline == $row->id_SalesPipeline) echo 'selected'; ?> > <?php echo $row->title; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
        </div>
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">Client</label>
            <div class="col-sm-10">
            <?php foreach($dataPipeline as $row) : ?>
                <input type="hidden" id="id_SalesPipeline" name="id_SalesPipeline" value="<?php echo $row->id_SalesPipeline; ?><?php if(!empty($dataVideo) && $dataVideo->id_SalesPipeline == $row->id_SalesPipeline) echo $row->client_name; ?>"> 
            <?php endforeach;?>
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Storyboard</label>
            <div class="col-sm-10">
            <input type="text" placeholder="PIC" id="storyboard_pic" name="storyboard_pic" value="<?php if(!empty($dataVideo)) echo $dataVideo->storyboard_pic; ?>"> 
            <input type="date" id="storyboard_date" name="storyboard_date" value="<?php if(!empty($dataVideo)) echo $dataVideo->storyboard_date; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Shooting</label>
            <div class="col-sm-10">
            <input type="text" placeholder="PIC" id="shooting_pic" name="shooting_pic" value="<?php if(!empty($dataVideo)) echo $dataVideo->shooting_pic; ?>"> 
            <input type="date" id="shooting_date" name="shooting_date" value="<?php if(!empty($dataVideo)) echo $dataVideo->shooting_date; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Editing</label>
            <div class="col-sm-10">
            <input type="text" placeholder="PIC" id="editing_pic" name="editing_pic" value="<?php if(!empty($dataVideo)) echo $dataVideo->editing_pic; ?>"> 
            <input type="date" id="editing_date" name="editing_date" value="<?php if(!empty($dataVideo)) echo $dataVideo->editing_date; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
            <textarea placeholder="Catatan" id="remark" name="remark" class="form-control" id="exampleFormControlTextarea1" value="<?php if(!empty($dataVideo)) echo $dataVideo->remark; ?>" rows="3"></textarea> 
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