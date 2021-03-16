<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="700" >
<section>
    <div class="container">
    <h2> <i class="fas fa-user-tie"></i> Employee Form Update</h2>
    <hr>
        <form enctype="multipart/form-data" method="POST" action="<?php echo site_url('Employee/saveUpdate'); ?>">
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
            <label class="col-sm-2 col-form-label">Role </label>
            <div class="col-sm-10">
                    <select required name="level" id="level" class="form-select" aria-label="Default select example">
                            <option selected><?php if(!empty($dataEmployee)) echo $dataEmployee->level; ?> </option>
                            <option value="admin"><span class="badge badge-primary"> admin </span></option>
                            <option value="user"><span class="badge badge-warning"> user </span></option>
                          
                            
                    </select>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label">Photo </label>
            <div class="col-sm-10">
            <img src="<?php if(empty($dataEmployee)){
                echo base_url('http://placehold.it/150x150');
            }else{
                echo base_url('assets/uploads/profile/'.$dataEmployee->photo);
            } ?>" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
            
            <input  class="form-control" type="file" id="photo" name="photo" value="<?php if(!empty($dataEmployee)) echo base_url('assets/uploads/profile/'.$dataEmployee->photo); ?>">
            <label class="form-label" for="customFile" style="color: red; font-size: 12px;"> * Upload Data (Max: 5MB, Format: PDF, JPG, PNG)</label>
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