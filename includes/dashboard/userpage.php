<div class="offset-md-3 col-md-6">
    <div class="userAttendance text-center">
        <?php if (!empty($_SESSION["user"]["extra"]["profile_pic"])) { ?>
            <img src="<?php echo SITE_URL; ?>/imgs/default-user.png" alt="User Default Image" />
        <?php } else { ?>
            <div class="userimage">
                <h2><?php echo substr($_SESSION["user"]["extra"]["first_name"], 0, 1) . "" . substr($_SESSION["user"]["extra"]["last_name"], 0, 1); ?></h2>
            </div>
        <?php } ?>

        <h2 class="mt-3">Hello <?php echo $_SESSION["user"]["extra"]["first_name"] . " " . $_SESSION["user"]["extra"]["last_name"]; ?></h2>
        <?php if (empty($user_obj->check_attendance_of_today())) { ?>
            <form method="POST" class="mt-3">
                <input type="hidden" name="action" value="mark_attendance" />
                <button type="submit" class="btn btn-success btn-block btn-lg">Add your Attendance for <?php echo date("F j, Y, g:i A"); ?> </button>
            </form>
        <?php } else { ?>
            <button class="btn btn-primary btn-block btn-lg">Already added Attendance for <?php echo date("F j, Y"); ?> </button>
        <?php } ?>
    </div>
</div>