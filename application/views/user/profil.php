
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

                    
                    <?php echo $this->session->flashdata('message'); ?>

                    <div class="card mb-3" style="max-width: 540px;">
                      <div class="row g-0">
                        <div class="col-md-4">
                          <img src="<?php echo base_url('assets/img/profile/').$user['image']; ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $user['name']; ?></h5>
                            <p class="card-text"><?php echo $user['email']; ?></p>
                            <p class="card-text"><small class="text-muted">Member sign since <?php echo date('d F y', $user['date_created']); ?></small></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a href="<?php echo base_url('user/edit_profil/').$user['id'] ?>" class="btn btn-primary mb-3">Edit profil</a>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
