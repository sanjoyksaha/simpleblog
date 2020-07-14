<?php $title = "My Posts"; require_once ROOT_APP . '/views/inc/header.php'; ?>
    <div class="row">
        <?php foreach($data['userPosts'] as $userPost): ?>
            <div class="card col-md-12 mb-3">
                <div class="card-body">
                    <div class="card-title">
                        <div class="col-md-12">
                            <h3><?= $userPost->title ?></h3>
                            <span class="font-weight-bold">Written On <?= date("M-d, Y", strtotime($userPost->created_at)) ?></span>
                        </div>
                        
                        <div class="col-md-12">
                            <?php if($userPost->image): ?>
                                <img src="<?= ROOT_URL ?>/public/images/posts/<?= $userPost->image ?>" alt="" class="img-thumbnail mt-3" style="width: 250px; height: 200px;">
                            <?php endif;?>
                            <a href="<?= ROOT_URL ?>/posts/show/<?= $userPost->id ?>" class="btn btn-info btn-block btn-sm mt-4">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php require_once ROOT_APP . '/views/inc/footer.php'; ?>