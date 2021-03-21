<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-users"></i> Client Form Input </h2>
    <hr>
        <form method="POST" action="<?php echo base_url('Client/update'); ?>">
        <div hidden class="form-group row">
            <label hidden class="col-sm-2 col-form-label">Client Name</label>
            <div hidden class="col-sm-10">
                <input hidden required type="text" class="form-control" id="id_client" name="id_client" value="<?php if(!empty($dataClient)) echo $dataClient->id_client; ?>"> 
            </div>
        </div>
       
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Type of business </label>
            <div class="col-sm-10">
                    <select required name="id_class" class="form-select" aria-label="Default select example">
                        
                        <?php foreach($dataClass as $row) : ?>
                            <option value="<?php echo $row->id_class; ?>"<?php if(!empty($dataClient) && $dataClient->id_class == $row->id_class) echo 'selected'; ?> > <?php echo $row->sector; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Address </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address_client" name="address_client" required
                value="<?php if(!empty($dataClient)) echo $dataClient->address_client; ?>">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email_client" name="email_client" required
                value="<?php if(!empty($dataClient)) echo $dataClient->email_client; ?>">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phone" name="phone" required
                value="<?php if(!empty($dataClient)) echo $dataClient->phone; ?>">
            </div>
        </div>
        <br>

        <div class="form-group row">
                <label class="col-sm-2 col-form-label">PIC </label>
                <div class="col-sm-10">
                    <select required name="nik" class="form-select" aria-label="Default select example">
                        
                        <?php foreach($dataEmployee as $row) : ?>
                            <option value="<?php echo $row->nik; ?>"<?php if(!empty($dataClient) && $dataClient->nik == $row->nik) echo 'selected'; ?> > <?php echo $row->name; ?> </option>
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