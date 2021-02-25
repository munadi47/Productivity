<div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-money-bill"></i> Finance Form Input </h2>
    <hr>
        <form method="POST" action="<?php echo site_url('Finance/save'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_finance" name="id_finance" value="<?php if(!empty($dataFinance)) echo $dataFinance->id_finance; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Client </label>
            <div class="col-sm-10">
                <select name="id_client" class="form-select" aria-label="Default select example">
                    
                    <?php foreach($dataClient as $row) : ?>
                        <option value="<?php echo $row->id_client; ?>"<?php if(!empty($dataFinance) && $dataFinance->id_client == $row->id_client) echo 'selected'; ?> > <?php echo $row->id_client; ?> </option>
                    <?php endforeach;?>
                    
                </select>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Invoice Create </label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="invoice_date" name="invoice_date" required
                value="<?php if(!empty($dataFinance)) echo $dataFinance->invoice_date; ?>">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Invoice Due Date </label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="invoice_duedate" name="invoice_duedate" required
                value="<?php if(!empty($dataFinance)) echo $dataFinance->invoice_duedate; ?>">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Ammount </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="invoice_amount" name="invoice_amount" required
                value="<?php if(!empty($dataFinance)) echo $dataFinance->invoice_amount=number_format($dataFinance->invoice_amount,0,",","");; ?>">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Status </label>
            <div class="col-sm-10">
                <select name="id_fStatus" class="form-select" aria-label="Default select example">
                    
                    <?php foreach($datafinancestatus as $row) : ?>
                        <option value="<?php echo $row->id_fStatus; ?>"<?php if(!empty($dataFinance) && $dataFinance->id_fStatus == $row->id_fStatus) echo 'selected'; ?> > <?php echo $row->status; ?> </option>
                    <?php endforeach;?>
                    
                </select>
            </div>
        </div>
        <br>


        <br>
      
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" onclick="window.history.back();" class="btn btn-outline-secondary">Back</button>
       
        </form>
    </div>
</section>
</div>