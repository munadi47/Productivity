<div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="zoom-in" data-aos-duration="1000" >
<section>
    <div class="container">
    <h2><i class="fas fa-users"></i> Client Form Input </h2>
    <hr>
        <form method="POST" action="<?php echo site_url('Client/save'); ?>">
        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_client" name="id_client" value="<?php if(!empty($dataClient)) echo $dataClient->id_client; ?>"> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Client </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="client_name" name="client_name" required
                value="<?php if(!empty($dataClient)) echo $dataClient->client_name; ?>">
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Address </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" name="address" required
                value="<?php if(!empty($dataClient)) echo $dataClient->address; ?>">
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
                    <select name="nik" class="form-select" aria-label="Default select example">
                        
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