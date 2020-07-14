<?php $title = "Posts"; require ROOT_APP . '/views/inc/header.php'; ?>
    <?php flash('post_message'); ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>All Post</h1>
        </div>
        <div class="col-md-6">
            <a href="<?= ROOT_URL?>/posts/create" class="btn btn-primary float-right">
                <i class="fas fa-plus"></i> Add Post
            </a>
        </div>
    </div>
    <?php foreach($data['posts'] as $post): ?>
        <div class="card col-md-12 mb-3 shadow-lg rounded">
            <div class="card-body">
                <div class="card-title">
                    <div class="col-md-12">
                        <h3><?= $post->title ?></h3>
                        
                        <span class="font-weight-bold" style="width:100%;">Written By <span class="text-success"><?= $post->name ?></span> On <?= date("M-d, Y", strtotime($post->postCreated)) ?></span>
                    </div>
                    <div class="col-md-12">
                        <?php if($post->image): ?>
                            <img src="<?= ROOT_URL ?>/public/images/posts/<?= $post->image ?>" alt="" class="img-thumbnail mt-3" style="width: 250px; height: 200px;">
                        <?php endif;?>
                        <a href="<?= ROOT_URL ?>/posts/show/<?= $post->PostId ?>" class="btn btn-info btn-block btn-sm mt-4">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>

<?php require ROOT_APP . '/views/inc/footer.php'; ?>
