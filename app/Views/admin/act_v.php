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

    <nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded " data-aos="fade-out" data-aos-duration="1000">
    <ol class="breadcrumb">
    
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-file"></i> Report</a></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-file-alt"></i> Activity Log</li>
    </ol>
    </nav>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
           
               
	<div class="row">
		<h2>Activity Log</h2>
		
	</div>
	<!--<div class="row">
			<div class="col-8">
			</div>
            <div class="col-4" >
            <form method="GET" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Keyword Disini..." name="keyword">
                <div class="input-group-append">
                    <button class="btn btn-info" name="submit" type="submit">Search</button>
                </div>
            </div>
            </form>
            </div>
        </div>  
-->
    <div class="qa-message-list" id="wallmessages myTable">
		<?php foreach($dataAct as $row):  ?>
    				<div class="message-item" id="m16">
						<div class="message-inner">
							<div class="message-head clearfix">
								<div class="avatar pull-left"><a href="./index.php?qa=user&qa_1=Oleg+Kolesnichenko"><img class="img-emp" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"></a></div>
								<div class="user-detail">
									<h5 class="handle"><?php echo $row->name; ?></h5>
									<div class="post-meta">
										<div class="asker-meta">
											<span class="qa-message-what"></span>
											<span class="qa-message-when">
												<span class="qa-message-when-data"><?php echo $row->datetime; ?></span>
											</span>
											<span class="qa-message-who">
												<span class="qa-message-who-pad">by </span>
												<span class="qa-message-who-data"><a href="./index.php?qa=user&qa_1=Oleg+Kolesnichenko"><?php echo $row->name; ?></a></span>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="qa-message-content">
								<?php echo $row->activity_name; ?>
							</div>
					    </div>
                    </div>
					<?php endforeach; ?>
                    <div class="float-right">
                    <?php echo $pager->links('dataAct', 'bootstrap_pagination'); ?>
                    </div>
					
        	
					
	</div>
</div>
        
    


</section>
