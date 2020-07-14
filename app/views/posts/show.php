<?php $title = "Single Post"; require_once ROOT_APP . '/views/inc/header.php'; ?>
<?php flash('post_message'); ?>
    <div class="row">
        <div class="col-md-12">
            <a href="<?= ROOT_URL ?>/posts" class="btn btn-light"><i class="fas fa-backward mr-2"></i>Back</a>
            <div class="card mt-3">
                <div class="card-header">
                    <div class="card-title">
                        <h3><?= $data['post']->title; ?></h3>
                        <span class="font-weight-bold text-success">Written By <?= $data['user']->name ?> On <?= $data['post']->created_at ?></span>
                    </div>
                </div>
                <div class="card-body">
                    <?php if($data['post']->image): ?>
                        <img src="<?= ROOT_URL ?>/public/images/posts/<?= $data['post']->image ?>" alt="" class="img-thumbnail mt-3" style="width: 250px; height: 200px;">
                    <?php endif; ?>
                    <p class="mt-3"><?= $data['post']->body ?></p>
                </div>
                <?php if($data['post']->user_id == $_SESSION['user_id']): ?>
                <div class="card-footer">
                    <a href="<?= ROOT_URL ?>/posts/edit/<?= $data['post']->id ?>" class="btn btn-primary">Edit</a>
                    <form action="<?= ROOT_URL ?>/posts/delete/<?= $data['post']->id ?>" method="POST" class="float-right" id="delete-form-<?= $data['post']->id ?>" enctype="multipart/form-data">
<!--                        <input type="submit" class="btn btn-danger" value="Delete">-->
                        <button type="submit" class="btn btn-danger"
                                onclick="if(confirm('You want delete this data, Sure?')){
                                    event.preventDefault();
                                    document.getElementById('delete-form-<?= $data['post']->id ?>').submit();
                                  }else{
                                    event.preventDefault();
                                  }
                                  ">Delete</button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php require_once ROOT_APP . '/views/inc/footer.php'; ?>