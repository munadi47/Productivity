<section>
    <div class="container">
    <h2 style="font-weight:bolder; ">Company Form Input </h2>
    <hr>
        <form method="POST" action="<?php echo site_url('Company/save'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_company" name="id_company" value="<?php if(!empty($dataCompany)) echo $dataCompany->id_company; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">COMPANY NAME</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="company_name" name="company_name" required
                value="<?php if(!empty($dataCompany)) echo $dataCompany->company_name; ?>">
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