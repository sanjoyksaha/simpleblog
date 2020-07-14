<?php $title="Change Password"; require ROOT_APP . '/views/inc/header.php'; ?>

    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="text-center">Change Password</h3>
                        <?php flash('success'); ?>
                        <hr>
                    </div>
                    <div class="card-body">
                        <form action="<?= ROOT_URL ?>/users/change_password/<?= $data['id']; ?>" method="POST">
                            <div class="form-group row">
                                <label for="new_password" class="col-md-4">New Password <sup>*</sup></label>
                                <div class="col-md-8">
                                    <input type="password" name="password" id="new_password" class="form-control <?php echo (!empty($data['err_password']) ? 'is-invalid' : ''); ?>">
                                    <span class="invalid-feedback"><?= $data['err_password'] ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirm_new_password" class="col-md-4">Confirm New Password <sup>*</sup></label>
                                <div class="col-md-8">
                                    <input type="password" name="confirm_password" id="confirm_new_password" class="form-control <?php echo (!empty($data['err_confirm_password']) ? 'is-invalid' : ''); ?>">
                                    <span class="invalid-feedback"><?= $data['err_confirm_password'] ?></span>
                                </div>
                            </div>
                            <input type="submit" value="Change Password" class="btn btn-primary btn-sm btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require ROOT_APP . '/views/inc/footer.php'; ?>