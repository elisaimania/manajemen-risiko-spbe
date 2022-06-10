<?= $this->extend('templates_auth/index'); ?>
<?= $this->section('content'); ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 ">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row h-100 justify-content-center align-items-center">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div id="flash"><?= session()->flash; ?></div>
                                    <form class="user" action="<?= base_url('auth/login') ?>" method="post" autocomplete="off">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="username" placeholder="Username" style="border-radius: 20px; border-color: #8CBA08;" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="password" placeholder="Password" style="border-radius: 20px; border-color: #8CBA08" required>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block border-0" style="background-color: #8CBA08;border-radius: 20px;" >
                                            Login
                                        </button>
                                        <hr>
                                        <a href="#" class="btn btn-primary btn-user btn-block border-0"  style="background-color: #8CBA08; border-radius: 20px" data-toggle="modal" data-target="#loginModal">
                                            <i></i> Login Dengan Akun BPS
                                        </a>
                                       
                                    </form>
                                
                                </div>
                            </div>
                            <div class="col-lg-6 d-none d-lg-block" style="background-color: #D8EF97;">
                                <img src="<?= base_url('assets/img/gambar_1.svg'); ?>" style="max-width: 100%; height: 650px;">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Login SSO Modal-->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 text-align="center" class="modal-title" id="exampleModalLabel">Login dengan akun BPS Anda!</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="flash"><?= session()->flash; ?></div>
                        <form class="user mb-5 mt-5" action="<?= base_url('auth/loginSSO') ?>" method="post" autocomplete="off">
                            <div class="form-group">
                                <input type="text" name="usernameSSO" class="form-control form-control-user"
                                                id="username" placeholder="Username" style="border-radius: 20px; border-color: #8CBA08;" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="passwordSSO" class="form-control form-control-user"
                                                id="password" placeholder="Password" style="border-radius: 20px; border-color: #8CBA08" required>
                            </div>
                            <button type="submit" name="loginSSO" class="btn btn-primary btn-user btn-block border-0" style="background-color: #8CBA08;border-radius: 20px;" >
                                            Login
                            </button>
                                       
                        </form>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div> 

    </div>
<?= $this->endSection(); ?>