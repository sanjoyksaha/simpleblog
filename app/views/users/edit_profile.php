<?php $title = "Edit Profile"; require ROOT_APP . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="text-center">Edit Profile</h3>
                        <hr>
                    </div>
                    <div class="card-body">
                        <form action="<?= ROOT_URL ?>/users/edit/<?= $data['id']; ?>" method="POST">
                            <div class="form-group row">
                                <label for="name" class="col-md-3">Name <sup>*</sup></label>
                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" class="form-control <?php echo (!empty($data['err_name']) ? 'is-invalid' : ''); ?>" value="<?= $data['name'] ?>">
                                    <span class="invalid-feedback"><?= $data['err_name'] ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-3">Email <sup>*</sup></label>
                                <div class="col-md-9">
                                    <input type="email" name="email" id="email" class="form-control <?php echo (!empty($data['err_email']) ? 'is-invalid' : ''); ?>" value="<?= $data['email'] ?>">
                                    <span class="invalid-feedback"><?= $data['err_email'] ?></span>
                                </div>
                            </div>
                            <input type="submit" value="Update" class="btn btn-primary btn-sm btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require ROOT_APP . '/views/inc/footer.php'; ?>