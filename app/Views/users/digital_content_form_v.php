<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-desktop"></i> Digital Form Input </h2>
    <hr>
    <br>
        <form method="POST" action="<?php echo site_url('Digital/save'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_digital" name="id_digital" value="<?php if(!empty($dataDigital)) echo $dataDigital->id_digital; ?>"> 
            </div>
        </div>
        
        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <select required name="id_SalesPipeline" class="form-select" aria-label="Default select example" >
                        
                        <?php foreach($dataPipeline as $row) : ?>
                            <option value="<?php echo $row->id_SalesPipeline; ?>"<?php if(!empty($dataDigital) && $dataDigital->id_SalesPipeline == $row->id_SalesPipeline) echo 'selected'; ?> > <?php echo $row->title; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Storyboard</label>
            <div class="col-sm-10">
            <input type="text" placeholder="PIC" id="storyboard_pic" name="storyboard_pic" value="<?php if(!empty($dataDigital)) echo $dataDigital->storyboard_pic; ?>"> 
            <input type="date" id="storyboard_date" name="storyboard_date" value="<?php if(!empty($dataDigital)) echo $dataDigital->storyboard_date; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Voiceover</label>
            <div class="col-sm-10">
            <input type="text" placeholder="PIC" id="voiceover_pic" name="voiceover_pic" value="<?php if(!empty($dataDigital)) echo $dataDigital->voiceover_pic; ?>"> 
            <input type="date" id="voiceover_date" name="voiceover_date" value="<?php if(!empty($dataDigital)) echo $dataDigital->voiceover_date; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Animate</label>
            <div class="col-sm-10">
            <input type="text" placeholder="PIC" id="animate_pic" name="animate_pic" value="<?php if(!empty($dataDigital)) echo $dataDigital->animate_pic; ?>"> 
            <input type="date" id="animate_date" name="animate_date" value="<?php if(!empty($dataDigital)) echo $dataDigital->animate_date; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Compile</label>
            <div class="col-sm-10">
            <input type="text" placeholder="PIC" id="compile_pic" name="compile_pic" value="<?php if(!empty($dataDigital)) echo $dataDigital->compile_pic; ?>"> 
            <input type="date" id="compile_date" name="compile_date" value="<?php if(!empty($dataDigital)) echo $dataDigital->compile_date; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
            <TEXTAREA NAME="remark" class="form-control" COLS=40 ROWS=6 ><?php if(!empty($dataDigital)) echo $dataDigital->remark; ?></TEXTAREA>
           
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