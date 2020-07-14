<?php $title = "Register"; require ROOT_APP . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h3>Create An Account</h3>
                    <p>*Please Fill Out The Form To Register</p>
                    <hr>
                    <form action="<?= ROOT_URL ?>/users/register" method="POST">
                        <div class="form-group row">
                            <label for="name" class="col-md-3">Name <sup class="text-danger">*</sup></label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name" class="form-control <?php echo (!empty($data['err_name'])) ? 'is-invalid' : ''; ?>" value="<?= $data['name'] ?>">
                                <span class="invalid-feedback"><?= $data['err_name'] ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3">Email <sup class="text-danger">*</sup></label>
                            <div class="col-md-9">
                                <input type="email" name="email" id="email" class="form-control <?php echo (!empty($data['err_email'])) ? 'is-invalid' : ''; ?>" value="<?= $data['email'] ?>">
                                <span class="invalid-feedback"><?= $data['err_email'] ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-3">Password <sup class="text-danger">*</sup></label>
                            <div class="col-md-9">
                                <input type="password" name="password" id="password" class="form-control <?php echo (!empty($data['err_password'])) ? 'is-invalid' : '' ; ?>" value="<?= $data['password'] ?>">
                                <span class="invalid-feedback"><?= $data['err_password'] ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-3">Confirm Password <sup class="text-danger">*</sup></label>
                            <div class="col-md-9">
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($data['err_confirm_password'])) ? 'is-invalid' : '' ; ?>" value="<?= $data['confirm_password'] ?>">
                                <span class="invalid-feedback"><?= $data['err_confirm_password']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <input type="submit" name="submit" id="submit" value="Register" class="btn btn-success btn-block btn-sm">
                            </div>
                            <div class="col">
                            <a href="<?= ROOT_URL?>/users/login" class="btn btn-light btn-block btn-sm">Have an account? Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require ROOT_APP . '/views/inc/footer.php'; ?>
