<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block" style="background-image: url('https://img.freepik.com/free-vector/augmented-intelligence-abstract-concept-illustration_335657-3792.jpg?w=740&t=st=1683709369~exp=1683709969~hmac=40e139230b726755eff2dff15a3b9ee3c4a7a3e8bcb9a7eb9c169861b5fad9d9'); background-position: center;
  background-size: cover;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Toko Token!</h1>
                                </div>

                                <?php echo $this->session->flashdata('message'); ?>

                                <form class="user" method="post" action="<?php echo base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukan alamat email..." value="<?php echo set_value('email');  ?>">
                                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" href="login.html" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?php echo base_url('auth/registration'); ?>">Buat Akun!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>