<?php require ROOT_APP . '/views/inc/header.php'; ?>
    <div class="jumbotron bg-dark">
        <div class="container">
            <h1 class="display-3 text-light"><?= $data['title']; ?></h1>
            <p class="lead text-light"><?= $data['description']; ?></p>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <p class="lead text-light"><?= $data['order']; ?></p>

                <p><a class="btn btn-primary btn-lg" href="<?= ROOT_URL ?>/users/register" role="button">Explore More &raquo;</a></p>
            <?php endif; ?>
        </div>
    </div>
    <?php if(isset($_SESSION['user_id'])): ?>
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-12">
                    <h3 class="mb-4 text-center text-danger">Latest Post</h3>
                </div>
                <div class="owl-carousel owl-theme">
                    <?php foreach($data['posts'] as $post): ?>
                        <div class="item" style="width: auto; height: 100px; background: #4DC7A0; text-align: center; padding:8px;">
                            <h5><?= $post->title ?></h5>
                            <span>
                                <?php
                                if(strlen($post->body) >= 1)
                                    echo substr($post->body, 0, 50) . '...';
                                ?>
                            </span>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php require ROOT_APP . '/views/inc/footer.php'; ?>