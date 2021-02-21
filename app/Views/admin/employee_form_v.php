<div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="zoom-in" data-aos-duration="700" >
<section>
    <div class="container">
    <h2>EMPLOYEE FORM INPUT </h2>
    <hr>
        <form method="POST" action="<?php echo site_url('Employee/save'); ?>">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nik" name="nik" required
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->nik; ?>">
                <input type="hidden" id="id" name="id" value="<?php if(!empty($dataEmployee)) echo $dataEmployee->nik; ?>"> 

            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">NAME</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" required
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->name; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" required
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->email; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">PASSWORD</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" name="password" required
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->password; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">PHONE</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phone1" name="phone1" required
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->phone1; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">PHONE 2</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phone2" name="phone2"
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->phone2; ?>">
            </div>
        </div>
        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status </label>
                <div class="col-sm-10">
                    <select required name="id_eStatus" class="form-select" aria-label="Default select example" >
                        
                        <?php foreach($dataEmpstatus as $row) : ?>
                            <option value="<?php echo $row->id_eStatus; ?>"<?php if(!empty($dataEmployee) && $dataEmployee->id_eStatus == $row->id_eStatus) echo 'selected'; ?> > <?php echo $row->status; ?> </option>
                        <?php endforeach;?>
                        
                    </select>
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