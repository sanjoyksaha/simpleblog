<?php $title = 'About Us'; require ROOT_APP . '/views/inc/header.php'; ?>

    <section class="jumbotron text-center bg-white">
        <div class="container">
            <h1><?= $data['title']; ?></h1>
              <p class="lead text-muted"><?= $data['description']; ?></p>
              <p>App Version: <b><?= APP_VERSION; ?></b></p>
        </div>
    </section>

<?php require ROOT_APP . '/views/inc/footer.php'; ?>