<?php $title = "Profile"; require ROOT_APP . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="text-center">Profile</h3>
                        <?php flash('success'); ?>
                        <hr>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>Name</td>
                                <td><?= $data['user']->name ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?= $data['user']->email ?></td>
                            </tr>
                        </table>
                        <a href="<?= ROOT_URL ?>/users/edit/<?= $data['user']->id ?>" class="btn btn-info btn-block btn-sm">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require ROOT_APP . '/views/inc/footer.php'; ?>