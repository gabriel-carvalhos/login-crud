<?php if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger" role="alert"><?= $_SESSION['error'] ?></div>
    <?php unset($_SESSION['error']); ?>
<?php } else if (isset($_SESSION['logout'])) { ?>
    <div class="alert alert-primary" role="alert"><?= $_SESSION['logout'] ?></div>
    <?php unset($_SESSION['logout']); ?>
<?php } else if (isset($_SESSION['logout'])) { ?>
    <div class="alert alert-primary" role="alert"><?= $_SESSION['logout'] ?></div>
    <?php unset($_SESSION['logout']); ?>
<?php } ?>