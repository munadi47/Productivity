<div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="zoom-in" data-aos-duration="1000" >
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
            <input required class="form-control" type="file" id="gantt_chart" name="gantt_chart" value="<?php if(!empty($dataConsul)) echo $dataConsul->gantt_chart; ?>">
            </div>
        </div>
        
                <!-- We'll transform this input into a pond -->
    
        <!-- Load FilePond library -->
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

        <!-- Turn all file input elements into ponds -->
        <script>
        FilePond.parse(document.body);
        </script>

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