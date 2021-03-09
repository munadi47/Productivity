<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="700" >
<section>
    <div class="container">
    <?php 
        $errors=session()->getFlashdata('errors'); 
        if (!empty($errors)){ ?>
            <div class="alert alert-danger" role="alert">
            <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
            </ul>
            </div>
        <?php } 
        ?>
        

    <h2> <i class="fas fa-user-tie"></i> Employee Form Add</h2>
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
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" required
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->name; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" name="address" required
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->address; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Birthday</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="birthday" name="birthday" required
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->birthday; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->email; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" required
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->password; ?>">
                <input type="checkbox" onclick="myFunction()" style="margin-top: 10px;"> Show Password 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phone1" name="phone1" required
                value="<?php if(!empty($dataEmployee)) echo $dataEmployee->phone1; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
                <input type="text" placeholder="Optional" class="form-control" id="phone2" name="phone2"
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
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Role </label>
            <div class="col-sm-10">
                    <select required name="level" id="level" class="form-select" aria-label="Default select example">
                            <option selected><?php if(!empty($dataEmployee)) echo $dataEmployee->level; ?> </option>
                            <option value="admin"><span class="badge badge-primary"> admin </span></option>
                            <option value="user"><span class="badge badge-warning"> user </span></option>
                          
                            
                    </select>
            </div>
        </div>
        
        <br>

    
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" onclick="window.history.back();" class="btn btn-outline-secondary">Back</button>
       

        </form>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            } 
    </script>
</section>
</div>