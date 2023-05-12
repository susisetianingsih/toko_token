<div class="container">
    <div class="col-xl-10 col-lg-12 col-md-9 mx-auto">
        <div class="card o-hidden border-0 shadow-lg my-5 ">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block" style="background-image: url('https://img.freepik.com/free-vector/electric-charge-electricity-generation-light-production-female-pc-user-with-electrical-appliance-cartoon-character-device-charging_335657-3384.jpg?w=740&t=st=1683708864~exp=1683709464~hmac=7fefcfec62b2f6834c7bee72d330f5de2dc582dcef1a1446a23df9d2a90301c5'); background-position: center;
  background-size: cover;"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
                            </div>
                            <form class="user" method="post" action="<?php echo base_url('auth/registration'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?php echo set_value('name'); ?>">
                                    <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>');
                                    ?>

                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email" value="<?php echo set_value('email'); ?>">
                                    <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                        <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                                        <?php echo form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <button type="submit" href="login.html" class="btn btn-primary btn-user btn-block">Daftar Akun
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?php echo base_url('auth'); ?>">Sudah punya akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>