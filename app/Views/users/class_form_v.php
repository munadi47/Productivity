<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-briefcase"></i> Business Type Form Input </h2>
    <hr>
        <form method="POST" action="<?php echo base_url('Client/save_class'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="hidden" class="form-control" id="id_class" name="id_class" value="<?php if(!empty($dataClass)) echo $dataClient->id_class; ?>"> 
            </div>
        </div>
       
   
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Type of business </label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="sector" name="sector" value="<?php if(!empty($dataClass)) echo $dataClient->sector; ?>"> 
               
            </div>
        </div>
        <br>
       
        <br>
        <br>
        <br>
           
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" onclick="window.history.back();" class="btn btn-outline-secondary">Back</button>
           
        </form>
    </div>
</section>
</div>