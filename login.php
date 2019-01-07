<?php
include_once 'config.php';
include_once 'classes/core.php';
include_once 'includes/header.php';
?>
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <h2 class="loginhead p-2 text-center"><?php echo WEBSITE_NAME; ?></h2>
        <div class="card-header text-center">Login</div>
        <div class="card-body">
            <?php include_once 'includes/notification.php'; ?>
            <form method="POST">
                <input type="hidden" name="action" value="login" />
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required="required" autofocus="autofocus" autocomplete="new-email">
                        <label for="inputEmail">Email address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required="required" autocomplete="new-password">
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="<?php echo SITE_URL; ?>register.php">Register an Account</a>
            </div>
        </div>
    </div>
</div>
<?php include_once 'includes/footer.php'; ?>