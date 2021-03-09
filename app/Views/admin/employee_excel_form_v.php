<section>
    <?php if(!empty(session()->getFlashdata('Success'))){ ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('Success');?>
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }elseif(!empty(session()->getFlashdata('Failed'))){ ?>
                    <div class="alert alert-danger">
                        <?php 
                            echo session()->getFlashdata('Failed');
                        ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    <?php
    }
    ?>

    <nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><i class="fas fa-table"></i> Company Data</li>
            <li class="breadcrumb-item" aria-current="page"><i class="fas fa-users"></i> Employee</li>
        </ol>
    </nav>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                <h2><i class="fas fa-upload"></i> Upload Excel </h2>
                <br>
                <form method="POST" action="<?php echo site_url('Employee/do_upload'); ?>" enctype="multipart/form-data">
                <input type="file" class="form-control" id="employee_file" name="employee_file" />
                <label class="form-label" for="customFile" style="color: red; font-size: 12px;"> * Upload Data (Max : 1024, Format : xlsx)</label>
                <br>
                <br>
                    
                    <button type="submit" class="btn btn-success btn-md">Save</button>
                    <button type="button" class="btn btn-secondary btn-md" onclick="goBack()">Cancel</button>
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
               
            </form>
                </div>
    </div>
</section>
