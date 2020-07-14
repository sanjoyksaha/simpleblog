<?php $title = "Edit Post"; require_once ROOT_APP . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-12">
            <a href="<?= ROOT_URL ?>/posts" class="btn btn-light"><i class="fas fa-backward mr-2"></i>Back</a>
            <div class="card mt-3">
                <div class="card-header">
                    <div class="card-title">
                        <h3>Edit Post</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= ROOT_URL ?>/posts/edit/<?= $data['id'] ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="title" class="col-md-3">Post Title <sup class="text-danger">*</sup></label>
                            <div class="col-md-9">
                                <input type="text" name="title" id="title" class="form-control <?php echo (!empty($data['err_title'])) ? 'is-invalid' : ''; ?>" value="<?= $data['title'] ?>" placeholder="Post Title Here..">
                                <span class="invalid-feedback"><?= $data['err_title'] ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="body" class="col-md-3">Body <sup class="text-danger">*</sup></label>
                            <div class="col-md-9">
                                <textarea name="body" id="body" cols="30" rows="10" class="form-control <?php echo (!empty($data['err_body'])) ? 'is-invalid' : ''; ?>" placeholder="Post Body Here.."><?= $data['body'] ?></textarea>
                                <span class="invalid-feedback"><?= $data['err_body'] ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-3">Image <sup class="text-danger">*</sup></label>
                            <div class="col-md-9">
                                <input type="file" name="image" id="image" class="form-control <?php echo (!empty($data['err_image'])) ? 'is-invalid':''; ?>">
                                <span class="invalid-feedback"><?= $data['err_image'] ?></span>
                                <?php if($data['image']): ?>
                                    <img src="<?= ROOT_URL ?>/public/images/posts/<?= $data['image'] ?>" alt="" style="width: 150px; height: 120px;">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-9 offset-md-3">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once ROOT_APP . '/views/inc/footer.php'; ?>