   
<?php if(empty($dataCompany)){ ?>
    <div class="alert alert-warning" role="alert"  data-aos="zoom-in" data-aos-duration="1000">
        Company data is empty, please input data first &nbsp; <a class="btn btn-info" href="<?php echo base_url('Company/add'); ?>"> <i class="fa fa-edit"></i> </a>
    </div>
<?php }?>


<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-archive"></i> Product Form Input </h2>
    <hr>
        <form method="POST" action="<?php echo site_url('Product/save'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_product" name="id_product" value="<?php if(!empty($dataProduct)) echo $dataProduct->id_product; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Product </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="product_name" name="product_name" required
                value="<?php if(!empty($dataProduct)) echo $dataProduct->product_name; ?>">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Standard Price </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="std_price" name="std_price" required
                value="<?php if(!empty($dataProduct)) echo $dataProduct->std_price; ?>">
            </div>
        </div>
        <br>

        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Company </label>
                <div class="col-sm-10">
                    <select required name="id_company" class="form-select" aria-label="Default select example" >
                        
                        <?php foreach($dataCompany as $row) : ?>
                            <option value="<?php echo $row->id_company; ?>"<?php if(!empty($dataProduct) && $dataProduct->id_company == $row->id_company) echo 'selected'; ?> > <?php echo $row->company_name; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
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