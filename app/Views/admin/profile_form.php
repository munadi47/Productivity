<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="700" >
<section>
    
    <div class="container">
    <h2> <i class="fas fa-user-tie"></i> Profile Update </h2>
    <hr>
    <p>
    *Each change must update or retype your password for confirmation
    </p>
        <form method="POST" action="<?php echo site_url('Employee/saveProfile'); ?>">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nik" name="nik" readonly="readonly"
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
                <input type="password" pattern=".{6,}" required title="6 characters minimum" class="form-control" id="password" name="password" placeholder="* Update or retype your password" required
                value="">
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
            <label class="col-sm-2 col-form-label">Photo </label>
            <div class="col-sm-10">
                <img style="width: 150px; height:150px;" src="<?php echo base_url(session()->get('photo')); ?>" />
                <br/>
                <input  class="form-control" type="file" id="photo_profile" name="photo_profile" value="<?php if(!empty($dataEmployee)) echo base_url('assets/uploads/profile/'.$dataEmployee->photo); ?>">
                <label class="form-label" for="customFile" style="color: red; font-size: 12px;"> * Upload Data (Max: 5MB, Format: JPG,JPEG,PNG)</label>
            </div>
        </div>
        
    
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