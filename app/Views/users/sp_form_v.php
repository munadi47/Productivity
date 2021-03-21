   
<?php if(empty($dataClient)){ ?>
    <div class="alert alert-warning" role="alert"  data-aos="zoom-in" data-aos-duration="1000">
        Client data is empty, please input data first &nbsp; <a class="btn btn-info" href="<?php echo base_url('Client/add'); ?>"> <i class="fa fa-edit"></i> </a>
    </div>
<?php }?>
   
<?php if(empty($dataProduct)){ ?>
    <div class="alert alert-warning" role="alert"  data-aos="zoom-in" data-aos-duration="1000">
        Product data is empty, please input data first &nbsp; <a class="btn btn-info" href="<?php echo base_url('Product/add'); ?>"> <i class="fa fa-edit"></i> </a>
    </div>
<?php }?>

   
<?php if(empty($dataEmployee)){ ?>
    <div class="alert alert-warning" role="alert"  data-aos="zoom-in" data-aos-duration="1000">
        PIC data is empty, please input data first &nbsp; <a class="btn btn-info" href="<?php echo base_url('Employee/add'); ?>"> <i class="fa fa-edit"></i> </a>
    </div>
<?php }?>


<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-chart-line"></i> Pipeline Form Input </h2>
    <hr>
    <br>
        <form method="POST" action="<?php echo site_url('SalesPipeline/save'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_SalesPipeline" name="id_SalesPipeline" value="<?php if(!empty($dataPipeline)) echo $dataPipeline->id_SalesPipeline; ?>"> 
            </div>
        </div>
        
        <div class="form-group row">
                <label class="col-sm-2 col-form-label">PIC</label>
                <div class="col-sm-10">
                    <select id="dropdown" required name="nik" class="form-select" aria-label="Default select example" >
                        
                        <?php foreach($dataEmployee as $row) : ?>
                            <option value="<?php echo $row->nik; ?>"<?php if(!empty($dataPipeline) && $dataPipeline->nik == $row->nik) echo 'selected'; ?> > <?php echo $row->name; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
        </div>
       
        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Client</label>
                <div class="col-sm-10">
                    <select id="dropdown" required name="id_client" class="form-select" aria-label="Default select example" >
                        
                        <?php foreach($dataClient as $row) : ?>
                            <option value="<?php echo $row->id_client; ?>"<?php if(!empty($dataPipeline) && $dataPipeline->id_client == $row->id_client) echo 'selected'; ?> > <?php echo $row->id_client; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
        </div>
  
        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Product</label>
                <div class="col-sm-10">
                    <select id="dropdown" required name="id_product" class="form-select" aria-label="Default select example" >
                        
                        <?php foreach($dataProduct as $row) : ?>
                            <option value="<?php echo $row->id_product; ?>"<?php if(!empty($dataPipeline) && $dataPipeline->id_product == $row->id_product) echo 'selected'; ?> > <?php echo $row->product_name; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
        </div>
  
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Project Title </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" required
                value="<?php if(!empty($dataPipeline)) echo $dataPipeline->title; ?>">
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Count </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="count" name="count" 
                value="<?php if(!empty($dataPipeline)) echo $dataPipeline->count; ?>">
            </div>
        </div>
       
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Potential Revenue </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="potential_revenue" name="potential_revenue"
                value="<?php if(!empty($dataPipeline)) echo $dataPipeline->potential_revenue; ?>">
            </div>
        </div>
      
        
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#count, #potential_revenue").keyup(function() {
                    var jumlah  = $("#count").val();
                    var potential = $("#potential_revenue").val();

                    var total = parseInt(jumlah) * parseInt(potential);
                    
                    $("#total_revenue").val(total);
                });
            });
        </script>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" id="total">Total Revenue </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="total_revenue" name="total_revenue" readonly=""
                value="<?php if(!empty($dataPipeline)) echo $dataPipeline->total_revenue; ?>">
            </div>
        </div>
      
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Status </label>
            <div class="col-sm-10">
                    <select required name="status_p" id="dropdown" class="form-select" data-live-search="true" aria-label="Default select example">
                            <option selected><?php if(!empty($dataPipeline)) echo $dataPipeline->status_p; ?> </option>
                            <option value="meeting"> meeting </option>
                            <option value="proposal">proposal</option>
                            <option value="closing">closing </option>
                            
                    </select>
                   
                 
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
