<?php
include_once 'config.php';
include_once 'classes/core.php';
include_once 'includes/header.php';
?>
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <h2 class="loginhead p-2 text-center"><?php echo WEBSITE_NAME; ?></h2>
        <div class="card-header text-center">Register an Account</div>
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="action" value="register"/> 
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" name="extra[first_name]" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                                <label for="firstName">First name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" name="extra[last_name]" id="lastName" class="form-control" placeholder="Last name" required="required">
                                <label for="lastName">Last name</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="required">
                        <label for="inputEmail">Email address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                                <label for="inputPassword">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="password" name="confirm_password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                                <label for="confirmPassword">Confirm password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="<?php echo SITE_URL; ?>login.php">Login</a>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'includes/footer.php';
?>
