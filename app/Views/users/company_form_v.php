<div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="zoom-in" data-aos-duration="700" >
<section>
    <div class="container">
    <h2>COMPANY FORM INPUT </h2>
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

        <div class="float-right">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" onclick="window.history.back();" class="btn btn-outline-secondary">Back</button>
        </div>

        </form>
    </div>
</section>
</div>