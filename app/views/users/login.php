<?php $title = "LogIn"; require ROOT_APP . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                <?php flash('register_success'); ?>
                    <h3>Login</h3>
                    <hr>
                    <form action="<?= ROOT_URL ?>/users/login" method="POST">
                        <div class="form-group row">
                            <label for="email" class="col-md-3">Email <sup>*</sup></label>
                            <div class="col-md-9">
                                <input type="email" name="email" id="email" class="form-control <?php echo (!empty($data['err_email']) ? 'is-invalid' : ''); ?>" value="<?= $data['email'] ?>">
                                  <span class="invalid-feedback"><?= $data['err_email'] ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-3">Password <sup>*</sup></label>
                            <div class="col-md-9">
                                <input type="password" name="password" id="password" class="form-control <?php echo (!empty($data['err_password']) ? 'is-invalid' : ''); ?>" value="<?= $data['password'] ?>">
                                <span class="invalid-feedback"><?= $data['err_password'] ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" name="submit" value="LogIn" class="btn btn-success btn-block btn-sm">
                            </div>
                            <div class="col">
                                <a href="<?= ROOT_URL?>/users/register" class="btn btn-light btn-block btn-sm">Don't have an account? Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require ROOT_APP . '/views/inc/footer.php'; ?>