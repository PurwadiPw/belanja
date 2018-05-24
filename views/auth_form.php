<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if($pesan): ?>
                <div class="alert alert-info">
                  <?= $pesan ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid decor_bg" id="login-panel">
        <div class="login-register-form-section">
            <ul class="nav nav-justified" role="tablist">
                <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
                <li><a href="#register" data-toggle="tab">Register</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="login">
                    <form class="form-horizontal" method="post" action="<?= base_url ?>/?page=auth">
                        <div class="form-group ">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input type="text" name="username" class="form-control" placeholder="Username" required="required" value="">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                <input type="password" name="user_password" class="form-control" placeholder="Password" required="required">
                            </div>
                        </div>
                        <input type="submit" name="do_login" value="Login" class="btn btn-success btn-custom">
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="register">
                    <form class="form-horizontal" method="post" action="<?= base_url ?>/?page=auth">
                        <div class="form-group ">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input type="text" name="user_username" class="form-control" placeholder="Username" required="required" value="">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                <input type="text" name="user_nama" class="form-control" placeholder="Full name" required="required" value="">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                <input type="email" name="user_email" class="form-control" placeholder="Email" required="required" value="">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                <input type="password" name="user_password" class="form-control" placeholder="Password" required="required">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                <input type="password" name="user_password_repeat" class="form-control" placeholder="Confirm Password" required="required">
                            </div>
                        </div>
                        <input type="submit" name="do_register" value="Register" class="btn btn-success btn-custom">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>