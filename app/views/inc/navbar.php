<nav class="navbar navbar-expand-md navbar-dark mb-3 bg-dark">
    <a class="navbar-brand ml-5" href="<?= ROOT_URL ?>"><?= SITE_NAME ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT_URL ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT_URL ?>/home/about">About</a>
            </li>
            <?php if(isset($_SESSION['user_id'])):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT_URL ?>/posts/index">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT_URL ?>/posts/my_post">My Posts</a>
                </li>
            <?php endif;?>
        </ul>
        <ul class="navbar-nav ml-auto mr-5">
            <?php if(isset($_SESSION['user_id'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome,
                    <?php echo $_SESSION['user_name']; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= ROOT_URL ?>/users/profile/<?= $_SESSION['user_id']; ?>"><i class="fas fa-user mr-2"></i>Profile</a>
                        <a class="dropdown-item" href="<?= ROOT_URL ?>/users/change_password/<?= $_SESSION['user_id']; ?>"><i class="fas fa-key mr-2"></i>Change Password</a>
                        <a class="dropdown-item" href="<?= ROOT_URL ?>/users/logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT_URL ?>/users/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT_URL ?>/users/register">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
