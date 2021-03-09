<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-building"></i> Company Form Input </h2>
    <hr>
        <form method="POST" action="<?php echo site_url('Company/save'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_company" name="id_company" value="<?php if(!empty($dataCompany)) echo $dataCompany->id_company; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Company Name </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="company_name" name="company_name" required
                value="<?php if(!empty($dataCompany)) echo $dataCompany->company_name; ?>">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Address </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" name="address" required
                value="<?php if(!empty($dataCompany)) echo $dataCompany->address; ?>">
            </div>
        </div>
       
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phone" name="phone" required
                value="<?php if(!empty($dataCompany)) echo $dataCompany->phone; ?>">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Field</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="field" name="field" required
                value="<?php if(!empty($dataCompany)) echo $dataCompany->field; ?>">
            </div>
        </div>
       
       
        <br>
        <br>
        <br>
      
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" onclick="window.history.back();" class="btn btn-outline-secondary">Back</button>
       
        </form>
    </div>
</section>
</div>